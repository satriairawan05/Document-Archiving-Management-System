<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Get access permissions for a specific page based on the user's group.
     *
     * This function retrieves the user's access permissions for a given page
     * and user group by querying the database and evaluating the actions
     * (Create, Read, Update, Delete) available for the page.
     *
     * @param string $pageName
     *    - The name or identifier of the page for which access permissions are requested.
     *    - Example: "Dashboard", "Profile", etc.
     *
     * @param string $userGroup
     *    - The user group of the current user.
     *    - Example: "Admin", "Editor", "User", etc.
     *
     * @return array
     *    - Returns an array of access permissions with actions as keys and their status as values.
     *    - Example for non-profile pages:
     *        [
     *            "Create" => 1,
     *            "Read" => 1,
     *            "Update" => 0,
     *            "Delete" => 0,
     *        ]
     *    - Example for the Profile page:
     *        [
     *            "Read" => 1,
     *            "Update" => 1,
     *        ]
     */
    public function get_access(string $pageName, string $userGroup)
    {
        $userRole = \App\Models\User::select(['group_pages.access', 'pages.page_name', 'pages.action'])
            ->leftJoin('group_pages', 'users.role_id', '=', 'group_pages.group_id')
            ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
            ->where('pages.page_name', '=', $pageName)
            ->where('group_pages.group_id', '=', (int) $userGroup)
            ->get();

        $create = 0;
        $read = 0;
        $update = 0;
        $delete = 0;

        foreach ($userRole as $r) {
            if ($r->page_name == $pageName) {
                if ($r->action == 'Create') {
                    $create = $r->access;
                }

                if ($r->action == 'Read') {
                    $read = $r->access;
                }

                if ($r->action == 'Update') {
                    $update = $r->access;
                }

                if ($r->action == 'Delete') {
                    $delete = $r->access;
                }
            }

            if ($r->page_name == 'Profile' && $pageName == 'Profile') {
                if ($r->action == 'Read') {
                    $read = $r->access;
                }

                if ($r->action == 'Update') {
                    $update = $r->access;
                }
            }
        }

        if ($pageName == 'Profile') {
            return [
                "Read" => (int) $read,
                "Update" => (int) $update,
            ];
        } else {
            return [
                "Create" => (int) $create,
                "Read" => (int) $read,
                "Update" => (int) $update,
                "Delete" => (int) $delete,
            ];
        }
    }

    /**
     * Get access permissions for a specific page based on the user's group.
     *
     * This function retrieves the sidebar access configuration for the given user group.
     * It determines which pages or sections the user is permitted to access.
     *
     * @param string $userGroup
     *    - The user group of the current user.
     *    - Examples: "admin", "editor", "viewer", etc.
     *    - This parameter is used to identify the access level and permissions for the given group.
     *
     * @return array
     *    - Returns an array containing access permissions for the sidebar.
     *    - The array structure may include:
     *        [
     *            'pages' => [
     *                'dashboard' => true,
     *                'settings' => false,
     *                ...
     *            ],
     *            'permissions' => [
     *                'view_reports' => true,
     *                ...
     *            ],
     *        ]
     *    - Keys and values in the array depend on the application logic and configuration.
     */
    public static function get_sidebar_access(string $userGroup)
    {
        return \App\Models\User::leftJoin('group_pages', 'users.role_id', '=', 'group_pages.group_id')
            ->leftJoin('groups', 'users.role_id', '=', 'groups.group_id')
            ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
            ->where('group_pages.access', '=', 1)
            ->where('group_pages.group_id', '=', (int) $userGroup)
            ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
            ->get();
    }

    /**
     * Generate Number for Incoming Mail or Outgoing Mail
     *
     * @param string $prefix
     *    - The prefix used for the mail type, e.g., "SK" (Surat Keputusan), "SM" (Surat Masuk), etc.
     *    - This parameter specifies the type of mail and is included in the generated number.
     *
     * @param int|null $latestMail
     *    - The latest mail record retrieved from the database.
     *    - This parameter should contain the `number` property, which indicates the last sequence number for the given mail type.
     *    - If `null`, the numbering will start from 1.
     *
     * @return string
     *    - The generated mail number in the format: "PREFIX-YYYY/MM/DD-XXXX".
     *    - Example: "SK-2024/12/06-0001".
     */
    public function generateNumber(string $prefix, $latestMail = null)
    {
        // Get today's date in the desired format
        $date = now()->format('Y/m/d'); // Format: YYYY/MM/DD

        // Determine the next number based on the latest mail
        $nextNumber = $latestMail ? $latestMail + 1 : 1;

        // Reset to 1 if it exceeds 9999
        if ($nextNumber > 9999) {
            $nextNumber = 1;
        }

        // Format the number with leading zeros
        $formattedNumber = str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        // Construct the full mail number
        return sprintf('%s-%s-%s', $prefix, $date, $formattedNumber);
    }
}

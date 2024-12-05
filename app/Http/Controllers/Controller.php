<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     *
     * Get access permission for a spesific page based on user group
     *
     * @param  string $pageName The name or identifier of the page.
     * @param  string $userGroup The user group of the current user.
     *
     * @return array Returns data in array format
     *
     */
    public function get_access(string $pageName, string $userGroup)
    {
        $userRole = \App\Models\User::select(['group_pages.access', 'pages.page_name', 'pages.action'])
            ->leftJoin('group_pages', 'users.role_id', '=', 'group_pages.group_id')
            ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
            ->where('pages.page_name', '=', $pageName)
            ->where('group_pages.group_id', '=', $userGroup)
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
     *
     * Get access permission for a spesific page based on user group
     *
     * @param  string $userGroup The user group of the current user.
     *
     * @return array Returns data in array format
     *
     */
    public static function get_sidebar_access(string $userGroup)
    {
        return \App\Models\User::leftJoin('group_pages', 'users.role_id', '=', 'group_pages.group_id')
            ->leftJoin('groups', 'users.role_id', '=', 'groups.group_id')
            ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
            ->where('group_pages.access', '=', 1)
            ->where('group_pages.group_id', '=', $userGroup)
            ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
            ->get();
    }
}

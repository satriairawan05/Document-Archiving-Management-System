<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pageNames = ['Incoming Mail', 'Outgoing Mail', 'Letter Type', 'Profile'];
        $actions = ['Create', 'Read', 'Update', 'Delete'];

        foreach ($pageNames as $pageName) {
            foreach ($actions as $action) {
                if ($pageName === 'Profile') {
                    if ($action === 'Read') {
                        \App\Models\Page::create([
                            'page_name' => $pageName,
                            'action' => $action,
                        ]);
                    }

                    if($action === 'Update'){
                        \App\Models\Page::create([
                            'page_name' => $pageName,
                            'action' => $action,
                        ]);
                    }
                } else {
                    \App\Models\Page::create([
                        'page_name' => $pageName,
                        'action' => $action,
                    ]);
                }
            }
        }
    }
}

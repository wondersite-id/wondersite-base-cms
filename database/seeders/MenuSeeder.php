<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;


class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $headerMenus = [
            [
                'name' => 'Home',
                'sequence_number' => 1,
                'type' => 'header',
                'url' => '/',
                'is_open_in_new_tab' => false,
            ],
            [
                'name' => 'Features',
                'sequence_number' => 2,
                'type' => 'header',
                'url' => '/features',
                'is_open_in_new_tab' => false,
            ],
            [
                'name' => 'Pricing',
                'sequence_number' => 3,
                'type' => 'header',
                'url' => '/pricing',
                'is_open_in_new_tab' => false,
            ],
            [
                'name' => 'Template',
                'sequence_number' => 4,
                'type' => 'header',
                'url' => '/templates',
                'is_open_in_new_tab' => false,
            ],
            [
                'name' => 'Articles',
                'sequence_number' => 5,
                'type' => 'header',
                'url' => '/articles',
                'is_open_in_new_tab' => false,
            ]
        ];

        foreach ($headerMenus as $menu) {
            Menu::create($menu);
        }

        $footerParentQuickLink = Menu::create([
            'name' => 'Quick Link',
            'sequence_number' => 1,
            'type' => 'footer',
            'url' => 'javascript:void(0)',
            'is_open_in_new_tab' => false,
        ]);

        $footerParentSocialLink = Menu::create([
            'name' => 'Social Link',
            'sequence_number' => 2,
            'type' => 'footer',
            'url' => 'javascript:void(0)',
            'is_open_in_new_tab' => false,
        ]);

        $footerMenus = [
            [
                'parent_id' => $footerParentQuickLink->id,
                'name' => 'Terms & Condition',
                'sequence_number' => 1,
                'type' => 'footer',
                'url' => '/terms',
                'is_open_in_new_tab' => false,
            ],
            [
                'parent_id' => $footerParentQuickLink->id,
                'name' => 'Privacy Policy',
                'sequence_number' => 2,
                'type' => 'footer',
                'url' => '/privacy',
                'is_open_in_new_tab' => false,
            ],
            [
                'parent_id' => $footerParentSocialLink->id,
                'name' => 'Instagram',
                'sequence_number' => 1,
                'type' => 'footer',
                'url' => 'https://instagram.com',
                'is_open_in_new_tab' => true,
            ],
            [
                'parent_id' => $footerParentSocialLink->id,
                'name' => 'Tiktok',
                'sequence_number' => 2,
                'type' => 'footer',
                'url' => 'https://tiktok.com',
                'is_open_in_new_tab' => true,
            ],
        ];

        foreach ($footerMenus as $menu) {
            Menu::create($menu);
        }
    }
}
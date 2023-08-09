<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class BaseSettingSeeder extends Seeder
{
    // wysiwyg, text, textarea, image, switch

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'name' => 'home-website-name',
                'type' => 'home',
                'form_type' => 'text',
                'title' => 'Home Website Name',
                'description' => 'Website name will be shown on every page and CMS header',
                'value' => 'Wondersite',
            ],
            [
                'name' => 'home-banner-title',
                'type' => 'home',
                'form_type' => 'wysiwyg',
                'title' => 'Home Banner Title',
                'description' => 'It will be on section title of home page banner area',
                'value' => 'Give Your customers human feeling touch <strong>Like Never Before</strong>',
            ],
            [
                'name' => 'home-banner-description',
                'type' => 'home',
                'form_type' => 'textarea',
                'title' => 'Home Banner Description',
                'description' => 'It will be on section description of home page banner area',
                'value' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, seddiam nonumy eirmod tempor invidunt ut labore et dolore magna',
            ],
            [
                'name' => 'home-banner-image',
                'type' => 'home',
                'form_type' => 'image',
                'title' => 'Home Banner Image',
                'description' => 'It will be on section image of home page banner area',
                'value' => 'https://wondersite-id.github.io/images/screenshots/banner-shot.png',
            ],
            [
                'name' => 'home-banner-video',
                'type' => 'home',
                'form_type' => 'text',
                'title' => 'Home Banner Video URL',
                'description' => 'It will be on section video of home page banner area',
                'value' => 'https://www.youtube.com/embed/dyZcRRWiuuw',
            ],
            [
                'name' => 'home-main-feature-title',
                'type' => 'home',
                'form_type' => 'text',
                'title' => 'Home Main Feature Title',
                'description' => 'It will be on section title of home page main feature area',
                'value' => 'Our <strong>Main</strong> Features',
            ],
            [
                'name' => 'home-main-feature-description',
                'type' => 'home',
                'form_type' => 'textarea',
                'title' => 'Home Main Feature Description',
                'description' => 'It will be on section description of home page main feature area',
                'value' => 'Our <strong>Main</strong> Features',
            ],
            [
                'name' => 'home-main-trust-title',
                'type' => 'home',
                'form_type' => 'wysiwyg',
                'title' => 'Home Trust Us Title',
                'description' => 'It will be on section title of home page trust us area',
                'value' => 'Achieve Your Career Goals With Us Our <strong>Main</strong> Features',
            ],
            [
                'name' => 'home-main-trust-description',
                'type' => 'home',
                'form_type' => 'textarea',
                'title' => 'Home Trust Us Description',
                'description' => 'It will be on section description of home page trust us area',
                'value' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat sed. At vero eos et',
            ],
            [
                'name' => 'home-main-trust-number',
                'type' => 'home',
                'form_type' => 'wyswyig',
                'title' => 'Home Trust Us Description',
                'description' => 'It will be on section description of home page trust us area',
                'value' => '<div class="has-colored-text growth-rate-counter">
                                <div class="d-inline-block block-sm mr-30 mt-30">
                                    <h2 class="has-text-color font-weight-bold">
                                        <span class="jsCounter" data-count="10">10</span>+
                                    </h2>
                                    <p class="mt-10"> Available <br> Templates</p>
                                </div>
                                <div class="d-inline-block block mt-30">
                                    <h2 class="has-text-color font-weight-bold">
                                        <span class="jsCounter" data-count="5">5</span>+
                                    </h2>
                                    <p class="mt-10"> <br> Available Add-ons</p>
                                </div>
                                <div class="d-inline-block block mr-30 mt-30">
                                    <h2 class="has-text-color font-weight-bold">
                                        <span class="jsCounter" data-count="100">100</span>+
                                    </h2>
                                    <p class="mt-10"> Our <br> Active users</p>
                                </div>
                            </div>',
            ],
            [
                'name' => 'home-main-trust-icon',
                'type' => 'home',
                'form_type' => 'wysiwg',
                'title' => 'Home Trust Us Icon',
                'description' => 'It will be on section icon of home page trust us area',
                'value' => '<div class="row colored-icon-box">
                                <div class="col-sm-6 aos-init aos-animate" data-aos="fade-up">
                                    <div class="icon-box text-center shadow px-3 px-md-5 px-lg-2 py-5 mb-30">
                                        <i class="ti-thumb-up icon"></i>
                                        <h4 class="font-weight-bold text-black-200">Fully Secure</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                    <div class="icon-box text-center shadow px-3 px-md-5 px-lg-2 py-5 mb-30">
                                        <i class="ti-comments-smiley icon"></i>
                                        <h4 class="font-weight-bold text-black-200">Always Having A Great Supports</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                    <div class="icon-box text-center shadow px-3 px-md-5 px-lg-2 py-5 mb-30">
                                        <i class="ti-video-clapper icon"></i>
                                        <h4 class="font-weight-bold text-black-200">Customize Your Portfolio to be Private or Public</h4>
                                    </div>
                                </div>
                                <div class="col-sm-6 aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                                    <div class="icon-box text-center shadow px-3 px-md-5 px-lg-2 py-5 mb-30">
                                        <i class="ti-shield icon"></i>
                                        <h4 class="font-weight-bold text-black-200">Fully Prepared with Safe Condition
                                        </h4>
                                    </div>
                                </div>
                            </div>',
            ],
            [
                'name' => 'home-secondary-banner-title',
                'type' => 'home',
                'form_type' => 'wysiwyg',
                'title' => 'Home Secondary Banner Title',
                'description' => 'It will be on section title of home page secondary banner area',
                'value' => 'Create An Automated <strong>Workflow By Setting</strong>',
            ],
            [
                'name' => 'home-secondary-banner-description',
                'type' => 'home',
                'form_type' => 'textarea',
                'title' => 'Home Secondary Banner Description',
                'description' => 'It will be on section description of home page secondary banner area',
                'value' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, seddiam nonumy eirmod tempor invidunt ut labore et dolore magna',
            ],
            [
                'name' => 'home-secondary-banner-image',
                'type' => 'home',
                'form_type' => 'image',
                'title' => 'Home Secondary Banner Image',
                'description' => 'It will be on section image of home page secondary banner area',
                'value' => 'https://wondersite-id.github.io/images/screenshots/banner-shot.png',
            ],
            [
                'name' => 'home-tertiary-banner-title',
                'type' => 'home',
                'form_type' => 'wysiwyg',
                'title' => 'Home Tertiary Banner Title',
                'description' => 'It will be on section title of home page tertiary banner area',
                'value' => 'Who Are We And <strong>What Is Our Identity?</strong>',
            ],
            [
                'name' => 'home-tertiary-banner-description',
                'type' => 'home',
                'form_type' => 'wysiwyg',
                'title' => 'Home Tertiary Banner Description',
                'description' => 'It will be on section description of home page tertiary banner area',
                'value' => '<p class="pb-20 border-bottom mb-20">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                        diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat sed. At vero eos et
                        accusam et justo duo dolores</p>
                        <ul class="check-list list-unstyled">
                        <li class="mb-15">
                            <svg width="16" height="11" viewBox="0 0 18 13" class="text-primary mr-2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 6.125L6.91892 11L16 2" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            Habit building in essential steps choose habit Good Things
                        </li>
                        <li class="mb-15">
                            <svg width="16" height="11" viewBox="0 0 18 13" class="text-primary mr-2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 6.125L6.91892 11L16 2" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            Get an overview of Habit Calendars admiral general.
                        </li>
                        <li>
                            <svg width="16" height="11" viewBox="0 0 18 13" class="text-primary mr-2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 6.125L6.91892 11L16 2" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                            Start building habit with Habitify on platform to new
                        </li>
                    </ul>',
            ],
            [
                'name' => 'home-tertiary-banner-image',
                'type' => 'home',
                'form_type' => 'image',
                'title' => 'Home Tertiary Banner Image',
                'description' => 'It will be on section image of home page tertiary banner area',
                'value' => 'https://wondersite-id.github.io/images/about/01.jpg',
            ],
            [
                'name' => 'footer-choose-your-plan-title',
                'type' => 'footer',
                'form_type' => 'wysiwyg',
                'title' => 'Footer Choose Your Plan Title',
                'description' => 'It will be on footer section of every page',
                'value' => 'Choose Your Plan and Favourite Template @ <strong>Wondersite</strong>',
            ],
            [
                'name' => 'footer-choose-your-plan-button',
                'type' => 'footer',
                'form_type' => 'text',
                'title' => 'Footer Choose Your Plan Button',
                'description' => 'It will be on footer section of every page',
                'value' => 'Choose Your Plan',
            ],
            [
                'name' => 'footer-description',
                'type' => 'footer',
                'form_type' => 'text',
                'title' => 'Footer Description',
                'description' => 'It will be on footer section of every page',
                'value' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore dolore magna aliquyam eratnonumy onsetetur',
            ],
            [
                'name' => 'other-business-maintenance-mode',
                'type' => 'other',
                'form_type' => 'switch',
                'title' => 'Business Maintenance Mode',
                'description' => 'It will turn on/turn off maintenance mode for business website',
                'value' => 'no',
            ],
            [
                'name' => 'other-customer-maintenance-mode',
                'type' => 'other',
                'form_type' => 'switch',
                'title' => 'Customer Maintenance Mode',
                'description' => 'It will turn on/turn off maintenance mode for customer website',
                'value' => 'no',
            ],
        ];

        foreach ($settings as $value) {
            $setting = Setting::updateOrCreate(['name' => $value['name']], $value);
            if ($value['form_type'] == "image") {
                $setting->saveImageUrl('value', $value['value'], 'url');
            }
        }
    }
}
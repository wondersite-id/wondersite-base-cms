<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            [
                'name' => 'Task Management',
                'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat sed. At vero eos et accusam et justo duo dolores etea',
                'sequence_number' => 1,
                'image' => 'https://wondersite-id.github.io/images/screenshots/how-it-works-1.jpg'
            ],
            [
                'name' => 'Collaborative Tasks',
                'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat sed. At vero eos et accusam et justo duo dolores etea',
                'sequence_number' => 2,
                'image' => 'https://wondersite-id.github.io/images/screenshots/how-it-works-1.jpg'
            ],
            [
                'name' => 'Built-In Documents',
                'description' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat sed. At vero eos et accusam et justo duo dolores etea',
                'sequence_number' => 3,
                'image' => 'https://wondersite-id.github.io/images/screenshots/how-it-works-1.jpg'
            ],
        ];

        foreach ($features as $value) {
            $value['published_at'] = \Carbon\Carbon::now();
            $object = Feature::updateOrCreate(['name' => $value['name']], $value);
            $object->saveImageUrl('image', $value['image'], 'url');

            $feature = Feature::find($object->id);
            $feature->seo->update([
                'title' => $value['name'],
                'description' => $value['description'],
                'image' => $feature->getFirstMedia('images')->getUrl(),
            ]);
        }
    }
}
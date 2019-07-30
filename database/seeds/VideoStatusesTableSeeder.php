<?php

use Illuminate\Database\Seeder;
use App\VideoStatus;
class VideoStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['new', 'uploading', 'uploaded','transcoded','draft', 'published'] as $slug){
            VideoStatus::create([
                'name' => ucfirst($slug),
                'slug' => $slug
            ]);
        }
    }
}

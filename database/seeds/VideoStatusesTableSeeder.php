<?php

use Illuminate\Database\Seeder;
use App\Status;
class VideoStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['new', 'received', 'processing','processed'] as $slug){
            Status::create([
                'name' => ucfirst($slug),
                'slug' => $slug
            ]);
        }
    }
}

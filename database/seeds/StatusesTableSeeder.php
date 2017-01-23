<?php

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = ['1','2','3'];
        $statuses = factory(\App\Models\Status::class)->times(100)->make()->each(function($statuses) use ($user_ids){
            $statuses->user_id = $user_ids[rand(0,2)];
        });
        Status::insert($statuses->toArray());
    }
}

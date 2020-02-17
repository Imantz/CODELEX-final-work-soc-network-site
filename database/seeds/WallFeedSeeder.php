<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WallFeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 4; $i++) {

            factory(App\WallFeed::class, 1)->create(
                [
                    "user_id" => $i
                ]
            );
        }
    }
}


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

            $name = ["","me","im following","im following", "im not Following"];

            factory(App\WallFeed::class, 1)->create(
                [
                    "name"=>  $name[$i],
                    "user_id" => $i
                ]
            );
        }
    }
}


<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Imants",
            'surname' => "Zuicans",
            'email' => "i@i",
            'password' => bcrypt('asdasdasd'),
            'slug'=>'1-Imants-Zuicans'
        ]);



        $userCount = 15;

        for($i=2;$i<$userCount;$i++)
        {
             factory(App\User::class, 1)->create([
                "slug"=> $i."-John-Bon",
            ]);
        }
    }
}

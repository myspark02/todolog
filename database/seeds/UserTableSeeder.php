<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
        	[
        		'name' => '박성철',
        		'email' => 'scpark@yju.ac.kr',
        		'password' => bcrypt('1111'),
        	],
        	[
        		'name' => '이몽룡',
        		'email' => 'mylee@myhost.com',
        		'password' => bcrypt('1111'),
        	]
        ];
        foreach($users as $u) {
        	App\User::create($u);
        }
    }
}

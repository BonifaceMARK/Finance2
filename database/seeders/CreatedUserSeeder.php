<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class CreatedUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
                ['name'=>'User',
                'username'=>'user',
                'email'=>'markluisbonifacio@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 0
                ]
                ];
                foreach($users as $user)
                {
                    User::create($user);
                }
    }
}

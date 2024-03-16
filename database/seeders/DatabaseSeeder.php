<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
                ['name'=>'Matthew',
                'username'=>'matthew',
                'email'=>'matthewcrew1zx@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 0
                ],
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

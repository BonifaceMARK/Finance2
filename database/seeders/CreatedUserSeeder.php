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
                'username'=>'User',
                'email'=>'user@markluisbonifacio.com',
                'password' => bcrypt('123456'),
                'role' => 0
                ],
                 ['name'=>'superadmin',
                 'username'=>'Superadmin',
                'email'=>'superadmin@markluisbonifacio.com',
                'password' => bcrypt('123456'),
                'role' => 1
                 ],

                ['name'=>'employee',
                'username'=>'employee',
                'email'=>'employee@markluisbonifacio.com',
                'password' => bcrypt('123456'),
                'role' => 2
                  ],
                ];
                foreach($users as $user)
                {
                    User::create($user);
                }
    }
}

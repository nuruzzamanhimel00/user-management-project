<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name'        => 'Super',
                'email'             => 'admin@app.com',
                'password'          => Hash::make('12345678'),   // 12345678

            ],
            [
                'name'        => 'editor',
                'email'             => 'editor@app.com',
                'password'          => Hash::make('12345678'),   // 12345678

            ],

        ];


        foreach ($users as $user) {
                $email =$user['email'];
                $data = collect($user)->except('email');
                User:: updateOrCreate(['email'=>$email],$data->toArray());
        }
    }
}

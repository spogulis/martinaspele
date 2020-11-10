<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            "userNames" => ["John Doe", 'Anne Frank', 'Marie Antoinette'],
            'emails '=> ['some@email.com', 'another@email.com', 'another@still.com'],
            'passwords' => ['test12345', 'test212345', 'test312345']
        ];
        
        User::create([
            'name' => 'John Doe',
            'email' => 'some@email.com',
            'password' => 'test12345'
        ]);

        User::create([
            'name' => 'Anne Frank',
            'email' => 'another@email.com',
            'password' => 'test212345'
        ]);

        User::create([
            'name' => 'Marie Antoinette',
            'email' => 'another@still.com',
            'password' => 'test312345'
        ]);


        // for ($i = 0; $i < count($users); $i++)
        // {
        //     User::create([
        //         'name' => $users['userNames'][$i],
        //         'email' => $users['emails'][$i],
        //         'password' => $users['passwords'][$i]
        //     ]);
        // }

        // foreach ($users as $userKey => $user)
        // {
        //     if (isset($users[$userKey] && isset($users)))
        //     User::create([
        //         'name' => $users[$userKey][0],
        //         'email' => $users[$userKey][$userKey],
        //         'password' => $users[$userKey][$userKey]
        //     ]);
        // }
    }
}

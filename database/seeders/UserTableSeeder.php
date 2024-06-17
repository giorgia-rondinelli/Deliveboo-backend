<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 20; $i++){
            $uid = $i+1;
            $user = new User();
            $user->name = 'admin'.$uid;
            $user->email = 'admin'.$uid.'@admin.com';
            $user->password = Hash::make('ciao1234');
            $user->save();
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RootUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "firstname" => "Administrator",
            "lastname" => "#",
            "login" => config("auth.root_login"),
            "password" => config("auth.root_password"),
        ]);
    }
}

<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Role::truncate();

        $user = User::create([
            'rut' => "18.311.347-K",
            'name' => "Jean",
            'email' => "jeancortes.t@gmail.com",
            'password' => bcrypt('a12345')
        ]);

        $role = Role::create([
            'name' => "Administrador",
            'description' => "Administrador del sitio web"
        ]);

        $user->role()->associate($role);
        $user->save();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
          array('name'=>'Administrador','lastname'=>'Pokedex','email'=>'admin@gmail.com','password'=>Hash::make('123456'),'picture'=>'','first_login'=>1,'type'=>1),
          array('name'=>'Entrenador 1','lastname'=>'Pokemon 1','email'=>'entrenador@gmail.com','password'=>Hash::make('123456'),'picture'=>'entrenador-1.png','first_login'=>0,'type'=>0),
          array('name'=>'Entrenador 2','lastname'=>'Pokemon 2','email'=>'entrenador2@gmail.com','password'=>Hash::make('123456'),'picture'=>'','first_login'=>0,'type'=>0)
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}

<?php

use App\User;
use App\Role;
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

      $adminRole = Role::where('name','admin')->first();
      $authorRole = Role::where('name','author')->first();
      $userRole = Role::where('name','user')->first();

      $admin = User::create([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('secretadmin'),
      ]);

      $author = User::create([
        'name' => 'author',
        'email' => 'author@author.com',
        'password' => bcrypt('secretauthor'),
      ]);

      $user = User::create([
        'name' => 'user',
        'email' => 'user@user.com',
        'password' => bcrypt('secretuser'),
      ]);

      $admin->roles()->attach($adminRole);
      $author->roles()->attach($authorRole);
      $user->roles()->attach($userRole);
    }
}

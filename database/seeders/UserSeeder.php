<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{SuperAdmin, Role, Admin, EndUser, Blogger};
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $info=[
        'name' => 'shehwar asif',
        'email' => 'admin@gmail.com',
        'password' =>  Hash::make('admin'),
        'status' => 'Active',
       ];
        $super = SuperAdmin::create($info);
        Role::create([  'role' => 'Super-Admin','users_id' => $super->id]);
        $admin = Admin::create($info);
        Role::create([  'role' => 'Admin','users_id' => $admin->id]);
        $user = EndUser::create($info);
        Role::create([  'role' => 'User','users_id' => $user->id]);
        $blogger = Blogger::create($info);
        Role::create([  'role' => 'Blogger','users_id' => $blogger->id]);


        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
     
            $super = SuperAdmin::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' =>  Hash::make('admin'),
                'status' => 'Active',
               ]);
            Role::create([  'role' => 'Super-Admin','users_id' => $super->id]);
            $admin = Admin::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' =>  Hash::make('admin'),
                'status' => 'Active',
               ]);
            Role::create([  'role' => 'Admin','users_id' => $admin->id]);
            $user = EndUser::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' =>  Hash::make('admin'),
                'status' => 'Active',
               ]);
            Role::create([  'role' => 'User','users_id' => $user->id]);
            $blogger = Blogger::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' =>  Hash::make('admin'),
                'status' => 'Active',
               ]);
            Role::create([  'role' => 'Blogger','users_id' => $blogger->id]);
        }
    }
}

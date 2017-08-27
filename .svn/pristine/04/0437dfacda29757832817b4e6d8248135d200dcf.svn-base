<?php

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
        factory(User::class)->create([
            'login' => 'test',
            'role' => 'admin',
            'email' => 'test@test.ru'
        ]);
        factory(User::class, 50)->create();
    }
}

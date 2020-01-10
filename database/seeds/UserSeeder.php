<?php


class UserSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        factory(\App\Entity\User::class)->create([
            'email' => 'admin',
            'name' => 'admin',
            'role' => \App\Entity\User::ADMIN,
        ]);
    }
}

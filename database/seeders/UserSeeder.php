<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $dev = User::create([
            'name'  => 'dev',
            'email'   => 'dev@test.com',
            'password' => bcrypt(123456)
        ]);
        $dev->assignRole('dev');

        $outsole = User::create([
            'name'  => 'os',
            'email'   => 'outsole@test.com',
            'password' => bcrypt(123456)
        ]);
        $outsole->assignRole('prod');

        $midsole = User::create([
            'name'  => 'ms',
            'email'   => 'midsole@test.com',
            'password' => bcrypt(123456)
        ]);
        $midsole->assignRole('prod');

        $stockfit = User::create([
            'name'  => 'sf',
            'email'   => 'stockfit@test.com',
            'password' => bcrypt(123456)
        ]);
        $stockfit->assignRole('prod');

        $upper = User::create([
            'name'  => 'up',
            'email'   => 'upper@test.com',
            'password' => bcrypt(123456)
        ]);
        $upper->assignRole('prod');

        $assembly = User::create([
            'name'  => 'as',
            'email'   => 'assembly@test.com',
            'password' => bcrypt(123456)
        ]);
        $assembly->assignRole('prod');
    }
}

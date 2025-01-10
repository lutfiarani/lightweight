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
            'fullname'  => 'development',
            'email'   => 'dev@test.com',
            'password' => bcrypt(123456)
        ]);
        $dev->assignRole('dev');

        $outsole = User::create([
            'name'  => 'os',
            'fullname'  => 'outsole',
            'email'   => 'outsole@test.com',
            'password' => bcrypt(123456)
        ]);
        $outsole->assignRole('prod');

        $midsole = User::create([
            'name'  => 'ms',
            'fullname'  => 'midsole',
            'email'   => 'midsole@test.com',
            'password' => bcrypt(123456)
        ]);
        $midsole->assignRole('prod');

        $stockfit = User::create([
            'name'  => 'sf',
            'fullname'  => 'stockfit',
            'email'   => 'stockfit@test.com',
            'password' => bcrypt(123456)
        ]);
        $stockfit->assignRole('prod');

        $upper = User::create([
            'name'  => 'up',
            'fullname'  => 'upper',
            'email'   => 'upper@test.com',
            'password' => bcrypt(123456)
        ]);
        $upper->assignRole('prod');

        $assembly = User::create([
            'name'  => 'as',
            'fullname'  => 'assembly',
            'email'   => 'assembly@test.com',
            'password' => bcrypt(123456)
        ]);
        $assembly->assignRole('prod');

        $sockliner = User::create([
            'name'  => 'sockliner',
            'fullname'  => 'sockliner',
            'email'   => 'sockliner@test.com',
            'password' => bcrypt(123456)
        ]);
        $sockliner->assignRole('prod');
    }
}

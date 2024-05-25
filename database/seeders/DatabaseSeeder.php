<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jabatans = ['Tenaga Pendidik', 'Tenaga Kependidikan', 'Laboran', 'Pembantu Umum'];
        for ($i = 0; $i < 4; $i++) {
            DB::table('jabatans')->insert([
                'jabatan'       => $jabatans[$i],
                'keterangan'    => $jabatans[$i],
                'statusjabatans'=> '1'
            ]);
        }
        $jabatansid = ['1', '2', '3', '4'];
        $roles = ['1', '2', '3'];
        $faker = Factory::create();

        for($i = 0; $i < 3; $i++){
            DB::table('users')->insert([
                'nuptk'             => $faker->unique()->numberBetween($min = 1, $max=99999),
                'nip'               => $faker->unique()->numberBetween($min = 1, $max=99999),
                'nama_lengkap'      => $faker->name,
                'jenis_kelamin'     => 'Laki-laki',
                'notelepon'         => $faker->phoneNumber,
                'jabatansid'        => $jabatansid[$i],
                'alamat'            => $faker->address,
                'role'              => $roles[$i],
                'fotos'             => 'default.jpg',
                'statususers'       => '1',
                'email'             => $faker->email,
                'password'          => Hash::make('password')
            ]);
        }
    }
}

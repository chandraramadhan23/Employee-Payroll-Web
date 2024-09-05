<?php

use App\Admin;
use App\Bagian;
use App\Karyawan;
use App\KaryawanInBagian;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Karyawan::create([
            'nik' => '12100034521',
            'nama' => 'Pratama Bagus S',
            'jenis_kelamin' => 'Laki-laki',
            'bagian' => 'Web Developer',
            'tanggal_masuk' => '2024-08-27'
        ]);

        Karyawan::create([
            'nik' => '99100088599',
            'nama' => 'Ananda Respodi',
            'jenis_kelamin' => 'Laki-laki',
            'bagian' => 'Data Analyst',
            'tanggal_masuk' => '2024-09-01'
        ]);

        Karyawan::create([
            'nik' => '12198700023',
            'nama' => 'Cyntia Agustin',
            'jenis_kelamin' => 'Perempuan',
            'bagian' => 'UI/UX Designer',
            'tanggal_masuk' => '2024-07-28'
        ]);

        Karyawan::create([
            'nik' => '45598700789',
            'nama' => 'Floren Putri Maleron',
            'jenis_kelamin' => 'Perempuan',
            'bagian' => 'UI/UX Designer',
            'tanggal_masuk' => '2024-07-28'
        ]);



        Bagian::create([
            'bagian' => 'Web Developer',
            'gaji_pokok' => 8000000,
            'transport' => 300000,
            'total_gaji' => 8000000 + 300000,
        ]);

        Bagian::create([
            'bagian' => 'Data Analyst',
            'gaji_pokok' => 7500000,
            'transport' => 300000,
            'total_gaji' => 7500000 + 300000,
        ]);

        Bagian::create([
            'bagian' => 'UI/UX Designer',
            'gaji_pokok' => 6000000,
            'transport' => 300000,
            'total_gaji' => 6000000 + 300000,
        ]);




        Admin::create([
            'nama' => 'Chandra Ramadhan',
            'username' => 'chandra',
            'password' => 'chandra',
        ]);

        Admin::create([
            'nama' => 'Meleni Alfianti',
            'username' => 'meleni',
            'password' => 'meleni',
        ]);
    }
}

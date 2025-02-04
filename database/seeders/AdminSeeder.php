<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin')->insert([
            [
                'namaadmin' => 'Super Admin',
                'username' => 'admin123',
                'password' => Hash::make('password123'),
                'status' => 'setujui',
                'role' => 'admin',
                'foto' => null,
                'setujui' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namaadmin' => 'Petugas Perpustakaan',
                'username' => 'petugas01',
                'password' => Hash::make('password123'),
                'status' => 'setujui',
                'role' => 'petugas',
                'foto' => null,
                'setujui' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namaadmin' => 'Ahmadi Muslim',
                'username' => 'ahmadi',
                'password' => Hash::make('ahmadi'),
                'status' => 'setujui',
                'role' => 'admin',
                'foto' => null,
                'setujui' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'namaadmin' => 'bangmuslim',
                'username' => 'bangmuslim',
                'password' => Hash::make('bangmuslim'),
                'status' => 'setujui',
                'role' => 'petugas',
                'foto' => null,
                'setujui' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'remember_token' => \Illuminate\Support\Str::random(10),
            'role_id' => 1
        ]);

        $dataUser = [
            'Asep Nugraha, S.Kom',
            'Rina Pratiwi, S.Kom',
            'Dedeh Suryani, S.Pd',
            'Joko Supriyanto, S.Tr.Kom',
            'Andrianto, S.Kom'
        ];

        $dataNip = [
            '198501022007011001',
            '198702152010012002',
            '199003122012032005',
            '198806102009042001',
            '199107152013072003'
        ];

        $dataRank = [
            'Pembina TK.I',
            'Penata TK.I',
            'Penata Muda TK.I',
            'Pengatur TK.I',
            'Pengatur'
        ];

        $dataGroup = [
            'IV.b',
            'III.d',
            'III.b',
            'II.d',
            'II.c'
        ];

        $dataPosition = [
            'Kepala Bidang Pengembangan Teknologi Informasi',
            'Pengelola Sistem Informasi',
            'Pranata Komputer Ahli Pertama',
            'Pengawas Sarana Pendidikan',
            'Penata Data Akademik'
        ];


        for ($i = 0; $i < count($dataUser); $i++) {
            $nameWithoutDegree = preg_replace('/,\s?[A-Z]+\.*\s?[A-Z]*/', '', $dataUser[$i]);

            \App\Models\User::create([
                'name' => $dataUser[$i],
                'email' => strtolower(str_replace(' ', '', $nameWithoutDegree)) . '@gmail.com',
                'email_verified_at' => now(),
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'remember_token' => \Illuminate\Support\Str::random(10),
                'role_id' => 2,
                'nip' => $dataNip[$i],
                'rank' => $dataRank[$i],
                'group' => $dataGroup[$i],
                'position' => $dataPosition[$i],
            ]);
        }
    }
}

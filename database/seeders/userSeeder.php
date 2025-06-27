<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create( [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'no_hp' => '087880182823',
            'level_id' => '1',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Pelatih Eskul',
            'email' => 'pelatiheskul@gmail.com',
            'no_hp' => '087880182823',
            'level_id' => '2',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Wali Kelas',
            'email' => 'walikelas@gmail.com',
            'no_hp' => '087880182823',
            'level_id' => '3',
            'password' => Hash::make(123456789),

        ]);
        User::Create( [
            'name' => 'Siswa',
            'email' => 'siswa@gmail.com',
            'no_hp' => '087880182823',
            'level_id' => '4',
            'password' => Hash::make(123456789),

        ]);





    }
}

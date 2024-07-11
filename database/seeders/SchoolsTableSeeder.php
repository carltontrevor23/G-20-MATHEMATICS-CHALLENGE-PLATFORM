<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('schools')->insert([
            'schoolName' => 'One Tree Primary School',
            'district' => 'Wakiso',
            'schoolRegNo' => 'PS001',
            'repName' => 'Agora Hills',
            'repEmail' => 'dojacat777@icloud.com',
            'email_verified_at' => now(),
            //'password' => Hash::make('secret'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

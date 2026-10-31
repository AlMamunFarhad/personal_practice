<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('business_settings')->insert([
            'id' => 1,
            'type' => 'admin_login_url',
            'value' => 'admin',
        ]);

        DB::table('business_settings')->updateOrInsert(
            ['type' => 'language'],
            [
                'value' => json_encode([
                    [
                        'id' => '1',
                        'name' => 'english',
                        'code' => 'en',
                        'status' => 1,
                        'default' => true,
                    ],
                ]),
                'updated_at' => now(),
            ]
        );

        DB::table('business_settings')->updateOrInsert(
        ['type' => 'recaptcha'],
        [
            'value' => json_encode([
                'status' => 0,
                'site_key' => '',
                'secret_key' => '',
            ]),
            'updated_at' => now(),
        ]
    );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('notifications')->insert([
            'notifiable_id'   => 1, // sesuaikan dengan user/admin ID
            'notifiable_type' => 'App\\Models\\User', // ganti jika Admin model
            'type'            => 'Brochure Downloaded',
            'message'         => 'Ada user download brochure',
            'data'            => json_encode([
                'title'   => 'Brochure Downloaded',
                'message' => 'Ada user download brochure',
                'url'     => '/admin/downloads',
                'popup'   => true,
            ]),
            'read_at'   => null,
            'is_read'   => 0,
            'icon'      => 'fa fa-download',
            'url'       => '/admin/downloads',
            'created_at'=> Carbon::now()->subMinutes(2),
            'updated_at'=> Carbon::now()->subMinutes(2),
        ]);
    }
}

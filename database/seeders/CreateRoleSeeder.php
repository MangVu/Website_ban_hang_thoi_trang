<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class CreateRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::beginTransaction();

        try {
            DB::table('roles')->insert([
                ['name' => 'admin', 'display_name' => 'Quản Trị Hệ Thống'],
                ['name' => 'guest', 'display_name' => 'Khách Hàng'],
                ['name' => 'developer', 'display_name' => 'Phát Triển Hệ Thống'],
                ['name' => 'editor', 'display_name' => 'Biên Tập Nội Dung'],

            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}

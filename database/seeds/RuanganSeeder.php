<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_user_rules')->insert([
        'id_rule' => 1,
        'id_menu' => 16,
        'id_level_user' => 4,
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('company_brands')->delete();
        $data = $this->data();
        foreach ($data as $value) {
            DB::collection('company_brands')->insert([
                'name' => $value, 'type' => 'BRAND', 'parent_id' => null
            ]);
        }
    }

    public function data() {
        return [
            'Wyeth nutrition',
            'Nature One diary',
            'Cow & Gate',
            'Kendamil',
            'SMA',
            'Fortilac',
            'Nutriben',
            'Nutriborn',
            'Moppet',
            'A2nutrition',
            'Bellamy',
            'Heinz',
            'Anmum'
        ];
    }

}

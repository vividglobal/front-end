<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViolationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('violation_types')->delete();
        $data = $this->data();
        foreach ($data as $key => $value) {
            DB::collection('violation_types')->insert($value);
        }
    }

    public function data() {
        return [
            ['name' => 'Promotion to the public', 'color' => '#4A2256'],
            ['name' => 'Labeling, packaging and messaging', 'color' => '#EEBA00'],
            ['name' => 'Information and Education', 'color' => '#0F62FE'],
            ['name' => 'Information for Health Workers', 'color' => '#0097A0'],
            ['name' => 'Sponsorships / Conflicts of Interest', 'color' => '#EF5DA8'],
            ['name' => 'BELOW ARE 2016 GUIDANCE [FOODS FOR INFANTS AND YOUNG CHILDREN]', 'color' => '#F37422']
        ];
    }
}

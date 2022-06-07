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
            ['name' => 'Promotion to the public', 'color' => '#A64AC9'],
            ['name' => 'Labeling, packaging and messaging', 'color' => '#FFCD04'],
            ['name' => 'Information and Education', 'color' => '#FFB48F'],
            ['name' => 'Information for Health Workers', 'color' => '#F5E6CC'],
            ['name' => 'Sponsorships / Conflicts of Interest', 'color' => '#17E9E0'],
            ['name' => 'BELOW ARE 2016 GUIDANCE [FOODS FOR INFANTS AND YOUNG CHILDREN]', 'color' => '#86C232']
        ];
    }
}

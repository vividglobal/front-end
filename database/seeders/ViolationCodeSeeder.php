<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ViolationCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('violation_code')->delete();
        $data = $this->data();
        foreach ($data as $value) {
            DB::collection('violation_code')->insert([
                'name' => $value, 'type_id' => null
            ]);
        }
    }

    public function data() {
        return [
            '5.1', '5.2', '5.3', '5.4', '5.5',

            '9.1',
            '9.2 (a)',
            '**9.2 (b)',
            'WHA58.32 [2005]',

            '4', '4.2', '4.3',

            '7.2',

            '7.5 & **WHA 49.15 [1996]',

            'WHO.Rec 4',
            'WHO.Rec5-Label',
            'WHO.Rec5-Promotion',
            'WHO.Rec6-Sample',
            'WHO.Rec6-Donation',
            'WHA 63.23 [2010]'
        ];
    }
}

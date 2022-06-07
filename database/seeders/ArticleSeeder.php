<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::collection('articles')->delete();
        $data = $this->data();
        for($i = 0 ; $i <= 10; $i++) {
            DB::collection('articles')->insert($data);
        }
    }

    public function data() {
        
        return [
            'company' => null,
            'country' => 'Philippines',
            'brand' => 'Kendamil',
            'caption' => 'NUÔI CON THÔNG MINH, DẠY CON TÌNH CẢM, CÙNG ENFA RINH QUÀ SINH NHẬT TỪ TIKI',
            'image' => 'https://scontent-syd2-1.xx.fbcdn.net/v/t1.6435-9/118766576_115542303614003_6296776245380403160_n.jpg?_nc_cat=103&ccb=1-7&_nc_sid=e3f864&_nc_ohc=V4xmoxq_lYUAX9UfBdg&_nc_ht=scontent-syd2-1.xx&oh=00_AT84OP5mJUnyd1kZyxkcWIwsICrSMBbjFxCxpim0dC_fhA&oe=62C48136',
            'published_date' => time(),
            'link' => 'https://www.facebook.com/EnfaSmartClubVN/photos/a.431073043607040/4106439432737031/',
            'bot_detecting' => [
                'violation_code' => ['5.1', '5.2', '5.3', '5.4', '5.5'],
                'violation_types' => [''],
                'crawl_date' => time(),
            ],
            'supervisor_review' => [
                'violation_code' => [''],
                'violation_types' => [''],
                'review_date' => null,
            ],
            'operator_review' => [
                'violation_code' => [''],
                'violation_types' => [''],
                'review_date' => null,
            ],
            'status' => 'PENDING',
            'progress_status' => 'NOT_STARTED',
            'detection_type' => 'BOT',
        ];
    }
}

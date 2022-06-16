<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mongo\Admin;
use App\Models\Mongo\Article;
use App\Models\Mongo\CompanyBrand;
use App\Models\Mongo\Country;
use App\Models\Mongo\ViolationCode;
use App\Models\Mongo\ViolationType;
use App\Models\Mongo\ArticleLegalDocument;

use App\Http\Requests\Article\CreateRequest;

class DummyController extends Controller
{
    public function articleIndex()
    {
        $articles = Article::all();
        $countries = Country::all();
        $types = ViolationType::all();
        $code = ViolationCode::all();
        $companies = CompanyBrand::all();
        return view('dummy/article', compact('articles', 'countries', 'types', 'code', 'companies'));
    }

    public function dummyArticles() {
        $companies = $countries = $violationCode = [];
        foreach (Country::all() as $key => $country) {
            $countries[] = [
                'id' => $country->_id,
                'name' => $country->name,
            ];
        }
        foreach (CompanyBrand::all() as $key => $brand) {
            $companies[] = [
                'id' => $brand->_id,
                'name' => $brand->name,
            ];
        }
        foreach (ViolationCode::all() as $key => $code) {
            $violationCode[] = $code->_id;
        }
        $imgAndLinks = [
            ['img' => 'https://static.hotdeal.vn/images/726/726439/500x500/153341-hop-sua-bot-meta-care-1-su-lua-chon-toi-uu-cho-tre-viet-900g.jpg', 'link' => 'https://www.hotdeal.vn/ho-chi-minh/thuc-pham/hop-sua-bot-meta-care-1-su-lua-chon-toi-uu-cho-tre-viet-900g-153341.html'],
            ['img' => 'https://www.hangngoainhap.com.vn/images/201805/goods_img/2296_P_1527303461160.jpg', 'link' => 'https://www.hangngoainhap.com.vn/2296-sua-bot-ensure-original-nutrition-powder-hop-400g-cua-my.html'],
            ['img' => 'https://bizweb.dktcdn.net/100/399/829/files/meiji-lon-so-0-800gr.jpg?v=1602141858299', 'link' => 'https://bekhoemexinh.com.vn/sua-bot-meiji-so-0-hop-800g-cho-tre-so-sinh-den-1-tuoi'],
            ['img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQClAAkHljjGI7ma18TojQuGVXGpW70hm1OyA&usqp=CAU', 'link' => 'https://suahop.vn/sua-bot-similac-isomil-iq-1-400g-237.html'],
            ['img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuALp0Dzi00tHo-i_E5FXfkdm5ax_rD3_EeQ&usqp=CAU', 'link' => 'https://shoptretho.com.vn/sua-bot-pediasure-ba-1600gr-1-10-tuoi'],
            ['img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuALp0Dzi00tHo-i_E5FXfkdm5ax_rD3_EeQ&usqp=CAU', 'link' => 'http://mychau.com.vn/hop-dung-sua-bot-nha-san-xuat-hop-dung-sua.html'],
            ['img' => 'https://www.queanhfood.vn/wp-content/uploads/2019/06/B%E1%BB%98T-%C4%82N-D%E1%BA%B6M-RIDIELAC-GOLD-G%E1%BA%A0O-S%E1%BB%AEA-H%E1%BB%98P-THI%E1%BA%BEC-350G.jpg', 'link' => 'https://www.queanhfood.vn/san-pham/bot-an-dam-ridielac-gold-gao-sua-hop-thiec-350g'],
            ['img' => 'https://www.queanhfood.vn/wp-content/uploads/2019/06/B%E1%BB%98T-%C4%82N-D%E1%BA%B6M-RIDIELAC-GOLD-G%E1%BA%A0O-S%E1%BB%AEA-H%E1%BB%98P-THI%E1%BA%BEC-350G.jpg', 'link' => 'https://www.queanhfood.vn/san-pham/bot-an-dam-ridielac-gold-gao-sua-hop-thiec-350g'],
            ['img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRUNlcE_XlGcQFcpoYJJ0reXCkC-SSIIb1FWA&usqp=CAU', 'link' => 'https://shoptretho.com.vn/sua-bot-pediasure-ba-1600gr-1-10-tuoi'],
            ['img' => 'https://vn-test-11.slatic.net/p/c2ce4a21da13450eb390c0277bf296af.jpg', 'link' => 'https://www.lazada.vn/tag/sua-bot-hop/?innerlink=hot_v1']
        ];
        $detectionType = ['BOT', 'MANUAL'];
        $dectionStatus = [Article::STATUS_NONE_VIOLATION, Article::STATUS_VIOLATION];
        $generatedArticle = 500;

        // Article
        for ($i=0; $i <= $generatedArticle ; $i++) {
            $botStatus = $dectionStatus[array_rand($dectionStatus)];
            if($botStatus === Article::STATUS_NONE_VIOLATION) {
                $violation_types_arr = $violation_code_arr = [];
            }else {
                $totalRandomCode = rand(0, 19);
                $listCodeIds = [];
                for ($j=0; $j < $totalRandomCode; $j++) { 
                    $listCodeIds[] = $violationCode[array_rand($violationCode)];
                }
                $listCodeIds = array_unique($listCodeIds);

                $codeData = $this->getViolationCodeAndTypeData($listCodeIds);
                $violation_code_arr = $codeData['violation_code'];
                $violation_types_arr = $codeData['violation_types'];
            }

            $imgAndLink = $imgAndLinks[array_rand($imgAndLinks)];
            $article = [
                'company' => [],
                'country' => $countries[array_rand($countries)],
                'brand'   => $companies[array_rand($companies)],
                'caption' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                'image'   => $imgAndLink['img'],
                'link'    => $imgAndLink['link'],
                'detection_result' => [
                    'violation_code'  => $violation_code_arr,
                    'violation_types' => $violation_types_arr,
                    'status'          => $botStatus,
                    'crawl_date'      => mt_rand(strtotime('01-05-2022'), time())
                ],
                'supervisor_review' => [
                    'violation_code'  => [],
                    'violation_types' => [],
                    "status"          => "PENDING",
                    'date'            => null
                ],
                'operator_review' => [
                    'violation_code'  => [],
                    'violation_types' => [],
                    "status"          => "PENDING",
                    'date'            => null
                ],
                'status'         => 'PENDING',
                'detection_type' => $detectionType[array_rand($detectionType)],
            ];

            Article::create($article);
        }

    }

    private function getViolationCodeAndTypeData($violationCodeArr) {
        $codex = ViolationCode::whereIn('_id', $violationCodeArr)->get();
        if($codex) {
            $listCode = [];
            $listTypes = [];
            foreach ($codex as $key => $code) {
                $listCode[] = [
                    'id' => $code->_id,
                    'name' => $code->name,
                ];
                $type = $code->violationType()->first();
                $listTypes[] = [
                    'id'    => $type->_id,
                    'name'  => $type->name,
                    'color' => $type->color
                ];
            }
            $unique_type_array = [];
            foreach($listTypes as $element) {
                $hash = $element['id'];
                $unique_type_array[$hash] = $element;
            }
            $violationTypes = array_values($unique_type_array);
            return [
                'violation_code'  => $listCode,
                'violation_types' => $violationTypes
            ];
        }
        return [];
    }

    public function articleCreate(CreateRequest $request)
    {
        $inputs = $request->all();
        $inputs['detection_result'] = [
            'violation_code' => [
                [
                    'id' => '629efb92a3e57bd29403b346',
                    'name' => '5.1'
                ],
                [
                    'id' => '629efb92a3e57bd29403b347',
                    'name' => '5.2'
                ]
            ],
            'violation_types' => [
                'id' => '629efb92a3e57bd29403b340',
                'name' => 'Promotion to the public'
            ],
            'date' => time(),
        ];
        if($inputs['status'] === Article::STATUS_VIOLATION) {
            $inputs['operator_review'] = $inputs['detection_result'];
            $inputs['operator_review']['status'] = Article::STATUS_REVIEW_DONE;
            $inputs['supervisor_review'] = $inputs['operator_review'];
        }else if($inputs['status'] === Article::STATUS_NONE_VIOLATION) {
            $inputs['operator_review'] =  $inputs['supervisor_review'] = [
                'violation_code' => [],
                'violation_types' => [],
                'status' => Article::STATUS_REVIEW_DONE,
                'review_date' => time(),
            ];
        }
        // Article::create($inputs);
        return redirect('/dummy/articles')->with('success', 'Create article successfully');
    }

    public function articelDelete($id)
    {
        $article = Article::findOrFail($id);
        $article->delete($id);
        return redirect('/dummy/articles')->with('success', 'Delete article successfully');
    }
}

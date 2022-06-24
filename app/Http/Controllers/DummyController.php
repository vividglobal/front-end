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
                'published_date'   => mt_rand(strtotime('01-05-2022'), time()),
                'detection_result' => [
                    'violation_code'  => $violation_code_arr,
                    'violation_types' => $violation_types_arr,
                    'status'          => $botStatus,
                    'date'            => mt_rand(strtotime('01-05-2022'), time())
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
        echo "It's done, now you can swim in a ton of articles!";

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

      // ============================================= //
     // ============== VIOLATION TYPE ============== //
    // ============================================ //
    public function violationTypes() {
        $violationTypes = ViolationType::all();
        return view('dummy/type', compact('violationTypes'));
    }

    public function createViolationTypes(Request $request)
    {
        $input = $request->all();
        ViolationType::create($input);
        return redirect('/dummy/violation-types')->with('success', 'Create successfully');
    }

    public function updateViolationTypes(Request $request ,$id)
    {
        $input = $request->all();
        $data = ViolationType::find($id);
        if($data) {
            $data->update($input);
            return $this->responseSuccess([], "Update  successfully");
        }
        return $this->responseFail([], "Update Failed");
    }

    public function deleteViolationTypes($id)
    {
        $data = ViolationType::find($id);
        $data->delete($id);
        
        return $this->responseSuccess([], "Delete successfully");
    }

      // ============================================= //
     // ============== VIOLATION TYPE ============== //
    // ============================================ //

    public function violationCode() {
        $violationTypes = ViolationType::all();
        $violationCode = ViolationCode::all();
        return view('dummy/code', compact('violationTypes', 'violationCode'));
    }

    public function createViolationCode(Request $request)
    {
        $input = $request->all();
        ViolationCode::create($input);
        return redirect('/dummy/violation-code')->with('success', 'Delete successfully');
    }

    public function updateViolationCode(Request $request ,$id)
    {
        $input = $request->all();
        $data = ViolationCode::find($id);
        if($data) {
            $data->update($input);
            return $this->responseSuccess([], "Update successfully");
        }
        return $this->responseFail([], "Update Failed");
    }

    public function deleteViolationCode($id)
    {
        $data = ViolationCode::find($id);
        $data->delete($id);
        return $this->responseSuccess([], "Delete successfully");
    }

      // ============================================= //
     // ============== BRAND COMPANY ============== //
    // ============================================ //

    public function companyBrands() {
        $companyBrands = CompanyBrand::all();
        return view('dummy/brand', compact('companyBrands'));
    }

    public function createCompanyBrands(Request $request)
    {
        $input = $request->all();
        if($input['type'] === CompanyBrand::TYPE_COMPANY) {
            $input['parent_id'] = null;
        }
        CompanyBrand::create($input);
        return redirect('/dummy/company-brands')->with('success', 'Create successfully');
    }

    public function updateCompanyBrands(Request $request ,$id)
    {
        $input = $request->all();
        $data = CompanyBrand::find($id);
        if($data) {
            if($input['type'] === CompanyBrand::TYPE_COMPANY) {
                $input['parent_id'] = null;
            }
            $data->update($input);
            return $this->responseSuccess([], "Update successfully");
        }
        return $this->responseFail([], "Update Failed");
    }

    public function deleteCompanyBrands($id)
    {
        $data = CompanyBrand::find($id);
        $data->delete($id);
        return $this->responseSuccess([], "Delete successfully");
    }

      // ============================================= //
     // ============== BRAND COMPANY ============== //
    // ============================================ //

    public function countries() {
        $countries = Country::all();
        return view('dummy/country', compact('countries'));
    }

    public function createCountries(Request $request)
    {
        $input = $request->all();
        $requestUrl = explode(',', $input['list_url']);
        if(count($requestUrl) === 0) {
            return redirect('/dummy/countries')->with('error', 'Please enter list url');
        }
        $listUrl = [];
        foreach ($requestUrl as $key => $url) {
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $listUrl[] = $url;
            }
        }
        if(count($listUrl) === 0) {
            return redirect('/dummy/countries')->with('error', 'Please enter list url');
        }
        $input['list_url'] = $requestUrl;
        Country::create($input);
        return redirect('/dummy/countries')->with('success', 'Create successfully');
    }

    public function updateCountries(Request $request ,$id)
    {
        $input = $request->all();
        $data = Country::find($id);
        if($data) {
            $requestUrl = explode(',', $input['list_url']);
            if(count($requestUrl) === 0) {
                return redirect('/dummy/countries')->with('error', 'Please enter list url');
            }
            $listUrl = [];
            foreach ($requestUrl as $key => $url) {
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    $listUrl[] = $url;
                }
            }
            if(count($listUrl) === 0) {
                return redirect('/dummy/countries')->with('error', 'Please enter list url');
            }
            $input['list_url'] = $requestUrl;
            $data->update($input);
            return $this->responseSuccess([], "Update successfully");
        }
        return $this->responseFail([], "Update Failed");
    }

    public function deleteCountries($id)
    {
        $data = Country::find($id);
        $data->delete($id);
        return $this->responseSuccess([], "Delete successfully");
    }
}

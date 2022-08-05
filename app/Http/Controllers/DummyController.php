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
use App\Http\Services\ArticleService;
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
        $articleService = new ArticleService();
        $articleService->createDummy();
        echo "It's done, now you can swim in a ton of articles!";

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

    public function dummyCountries() {
        $countries =  json_decode(file_get_contents(public_path('countries.json')));
        foreach($countries as $country) {
            $exists = Country::where('name', $country->name)->exists();
            if(!$exists) {
                Country::create([
                    'name' => $country->name,
                    'list_url' => []
                ]);
            }
        }
        echo 'Done';
    }

    public function createCountries(Request $request)
    {
        $input = $request->all();
        $requestUrl = explode(',', $input['list_url']);
        $listUrl = [];
        foreach ($requestUrl as $key => $url) {
            $url = preg_replace('/\s+/', '', $url);
            $url = strtolower($url);
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                $listUrl[] = $url;
            }
        }
        $input['list_url'] = $listUrl;
        Country::create($input);
        return redirect('/dummy/countries')->with('success', 'Create successfully');
    }

    public function updateCountries(Request $request ,$id)
    {
        $input = $request->all();
        $data = Country::find($id);
        if($data) {
            $requestUrl = explode(',', $input['list_url']);
            
            $listUrl = [];
            foreach ($requestUrl as $key => $url) {
                $url = preg_replace('/\s+/', '', $url);
                $url = strtolower($url);
                if (filter_var($url, FILTER_VALIDATE_URL)) {
                    $listUrl[] = $url;
                }
            }
            $input['list_url'] = $listUrl;
            $data->update($input);
            return $this->responseSuccess($listUrl, "Update successfully");
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

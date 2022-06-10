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
        Article::create($inputs);
        return redirect('/dummy/articles')->with('success', 'Create article successfully');
    }

    public function articelDelete($id)
    {
        $article = Article::findOrFail($id);
        $article->delete($id);
        return redirect('/dummy/articles')->with('success', 'Delete article successfully');
    }
}

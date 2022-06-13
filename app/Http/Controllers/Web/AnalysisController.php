<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Models\Mongo\Article;
use App\Models\Mongo\ViolationCode;
use App\Models\Mongo\CompanyBrand;

class AnalysisController extends Controller
{
    use ApiResponse;

    public function index(Request $request) {
        $generalData = $this->getGeneralData($request);
        $brandData = $this->getViolationBasedOnBrands($request);
        $codeData = $this->getViolationBasedOnCode($request);
        return view('pages/analysis/index', compact('generalData', 'brandData', 'codeData'));
    }

    public function getGeneralData(Request $request)
    {
        $params = $request->all();
        $articleModel = new Article();

        $total = $articleModel->getListCount($params);

        $params['status'] = Article::STATUS_VIOLATION;
        $violation = $articleModel->getListCount($params);
        $nonViolation = $total - $violation;
        $percentileViolation = round((($violation / $total ) * 100), 2);
        $percentileNonViolation = 100 - $percentileViolation;
        return [
            'non_violation' => $nonViolation,
            'violation'     => $violation,
            'total'         => $total,
            'percentile_violation'     => $percentileViolation,
            'percentile_non_violation' => $percentileNonViolation,
        ];
    }

    public function getViolationBasedOnBrands(Request $request)
    {
        $companyBrandModel = new CompanyBrand();
        $list = $companyBrandModel->analize($request->all());
        return $list;
    }

    public function getViolationBasedOnCode(Request $request)
    {
        $violationCodeModel = new ViolationCode();
        $list = $violationCodeModel->analize($request->all());
        return $list;
    }
}

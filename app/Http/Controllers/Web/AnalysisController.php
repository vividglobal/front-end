<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo\Article;
use App\Models\Mongo\ViolationCode;
use App\Models\Mongo\CompanyBrand;

use App\Http\Services\ExportService;

class AnalysisController extends Controller
{

    public function index(Request $request) {
        $params = $request->all();
        if(isset($params['export']) && $params['export'] == true) {
            return $this->exportAnalysis($params);
        }

        $generalData = $this->getGeneralData($params);
        $brandData = $this->getViolationBasedOnBrands($params);
        $codeData = $this->getViolationBasedOnCode($params);
        return view('pages/analysis/index', compact('generalData', 'brandData', 'codeData'));
    }

    public function getGeneralData($params)
    {
        $articleModel = new Article();
        $total = $articleModel->getListCount($params);

        $params['status'] = Article::STATUS_VIOLATION;
        $violation = $articleModel->getListCount($params);
        $nonViolation = $total - $violation;
        $percentileViolation = $total > 0 ? round((($violation / $total ) * 100), 2) : 0;
        $percentileNonViolation = $percentileViolation > 0 ? 100 - $percentileViolation : 0;
        return [
            'non_violation' => $nonViolation,
            'violation'     => $violation,
            'total'         => $total,
            'percentile_violation'     => $percentileViolation,
            'percentile_non_violation' => $percentileNonViolation,
        ];
    }

    public function getViolationBasedOnBrands($params, $shouldPaginate = true)
    {
        $companyBrandModel = new CompanyBrand();
        $list = $companyBrandModel->analize($params, $shouldPaginate);
        return $list;
    }

    public function getViolationBasedOnCode($params, $shouldPaginate = true)
    {
        $violationCodeModel = new ViolationCode();
        $list = $violationCodeModel->analize($params, $shouldPaginate);
        return $list;
    }

    public function exportAnalysis($params) {
        $generalData = $this->getGeneralData($params);
        $brandData = $this->getViolationBasedOnBrands($params, $shouldPaginate = false);
        $codeData = $this->getViolationBasedOnCode($params, $shouldPaginate = false);

        // Sheet General data
        $titles = [
            'Non-violation',
            'Violation',
            'Total articles',
            'Percentile of Violation',
            'Percentile of Non-violation'
        ];
        $exportData = [
            [
                $generalData['non_violation'],
                $generalData['violation'],
                $generalData['total'],
                $generalData['percentile_violation'].'%',
                $generalData['percentile_non_violation'].'%',
            ]
        ];
        $sheets[] = ['row_titles' => $titles, 'name' => 'General', 'data' => $exportData ];

        // Sheet Violation based on brands
        $titles = ['#', 'Brand/ Company', 'Articles', 'Violations', 'Percentage'];
        $exportData = [];
        foreach ($brandData as $key => $brand) {
            $exportData[] = [
                $key+1,
                $brand->name,
                $brand->total_article,
                $brand->total_violation_article,
                $brand->percent_violation_per_article.'%'
            ];
        }
        $sheets[] = ['row_titles' => $titles, 'name' => 'violation_based_brands', 'data' => $exportData ];

        // Sheet Violation based on code
        $titles = ['#', 'Code Article', 'Violation Types', 'Articles'];
        $exportData = [];
        foreach ($codeData as $key => $code) {
            $exportData[] = [
                $key+1,
                $code->name,
                $code->type_name,
                $code->total_article
            ];
        }
        $sheets[] = ['row_titles' => $titles, 'name' => 'violation_based_code', 'data' => $exportData ];
        return ExportService::exportExcelFile($sheets, $fileName = 'analysis-export');
    }
}

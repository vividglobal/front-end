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
        return view('pages/analysis/index');
    }

    private function _getGeneralData($params)
    {
        $articleModel = new Article();
        $total = $articleModel->getListCount($params);

        $params['status'] = Article::STATUS_VIOLATION;
        $violation = $articleModel->getListCount($params);

        $params['status'] = Article::STATUS_NONE_VIOLATION;
        $nonViolation = $articleModel->getListCount($params);
        $percentileViolation = $total > 0 ? round((($violation / $total ) * 100), 2) : 0;
        $percentileNonViolation = $total > 0 ? round((($nonViolation / $total ) * 100), 2) : 0;
        return [
            'non_violation' => $nonViolation,
            'violation'     => $violation,
            'total'         => $total,
            'percentile_violation'     => $percentileViolation,
            'percentile_non_violation' => $percentileNonViolation,
        ];
    }

    private function _getViolationBasedOnBrands($params, $shouldPaginate = true)
    {
        $companyBrandModel = new CompanyBrand();
        $list = $companyBrandModel->analize($params, $shouldPaginate);
        return $list;
    }

    private function _getViolationBasedOnCode($params, $shouldPaginate = true)
    {
        $violationCodeModel = new ViolationCode();
        $list = $violationCodeModel->analize($params, $shouldPaginate);
        return $list;
    }

    public function exportAnalysis($params) {
        $generalData = $this->_getGeneralData($params);
        $brandData = $this->_getViolationBasedOnBrands($params, $shouldPaginate = false);
        $codeData = $this->_getViolationBasedOnCode($params, $shouldPaginate = false);

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

      // ============================================ //
     // ================== AJAX ==================== //
    // =========================================== //
    public function getGeneralData(Request $request)
    {
        $generalData = $this->_getGeneralData($request->all());
        return view('pages/analysis/general', compact('generalData'));
    }

    public function getViolationBasedOnBrands(Request $request)
    {
        $brandData = $this->_getViolationBasedOnBrands($request->all());
        return view('pages/analysis/vio_based_brand_table', compact('brandData'));
    }

    public function getViolationBasedOnCode(Request $request)
    {
        $codeData = $this->_getViolationBasedOnCode($request->all());
        return view('pages/analysis/vio_based_code_table', compact('codeData'));
    }
}

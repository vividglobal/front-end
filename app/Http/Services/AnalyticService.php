<?php

namespace App\Http\Services;

use App\Models\Mongo\Admin;
use App\Models\Mongo\Article;
use App\Models\Mongo\ViolationCode;
use App\Models\Mongo\CompanyBrand;
use App\Models\Mongo\Country;

use App\Http\Services\ExportService;
use Illuminate\Support\Facades\Mail;
use App\Mail\AnalyticWeeklyReport;

class AnalyticService {

    public function getAutoDetectionParams($params) {
        $finalParams = $params;
        $finalParams['detection_type'] = Article::DETECTION_TYPE_BOT;
        $finalParams['status'] = Article::STATUS_PENDING;
        $finalParams['date_sort_field'] = 'published_date';
        if(!isset($finalParams['sort_by'])) {
            $finalParams['sort_by'] = $finalParams['date_sort_field'];
        }
        if(!isset($finalParams['sort_by'])) {
            $finalParams['sort_value'] = 'DESC';
        }

        return $finalParams;
    }

    public function getManualDetectionParams($params) {
        $finalParams = $params;
        $finalParams['detection_type'] = Article::DETECTION_TYPE_MANUAL;
        $finalParams['status'] = Article::STATUS_PENDING;
        $finalParams['date_sort_field'] = 'crawl_date';
        if(!isset($finalParams['sort_by'])) {
            $finalParams['sort_by'] = $finalParams['date_sort_field'];
        }
        if(!isset($finalParams['sort_by'])) {
            $finalParams['sort_value'] = 'DESC';
        }
        return $finalParams;
    }

    public function getViolationArticlesParams($params) {
        $finalParams = $params;
        $finalParams = $this->_getModeratedArticlesParams($finalParams);
        $finalParams['status'] = Article::STATUS_VIOLATION;
        return $finalParams;
    }

    public function getNoneViolationArticlesParams($params) {
        $finalParams = $params;
        $finalParams = $this->_getModeratedArticlesParams($finalParams);
        $finalParams['status'] = Article::STATUS_NONE_VIOLATION;
        return $finalParams;
    }

    private function _getModeratedArticlesParams($params) {
        $finalParams = $params;
        $finalParams['date_sort_field'] = 'checking_date';
        if(!isset($finalParams['sort_by'])) {
            $finalParams['sort_by'] = $finalParams['date_sort_field'];
        }
        if(!isset($finalParams['sort_by'])) {
            $finalParams['sort_value'] = 'DESC';
        }
        return $finalParams;
    }

    public function _getGeneralData($params)
    {
        $articleModel = new Article();

        $autoDetectionParams = $this->getAutoDetectionParams($params);
        $autoDetectionCount = $articleModel->getListCount($autoDetectionParams);

        $manualDetectionParams = $this->getAutoDetectionParams($params);
        $manualDetectionCount = $articleModel->getListCount($manualDetectionParams);

        $violationParams = $this->getViolationArticlesParams($params);
        $violationCount = $articleModel->getListCount($violationParams);

        $nonViolationParams = $this->getNoneViolationArticlesParams($params);
        $nonViolationCount = $articleModel->getListCount($nonViolationParams);

        $total = $autoDetectionCount + $manualDetectionCount + $violationCount + $nonViolationCount;

        $percentileViolation = $total > 0 ? round((($violationCount / $total ) * 100), 2) : 0;
        $percentileNonViolation = $total > 0 ? round((($nonViolationCount / $total ) * 100), 2) : 0;

        return [
            'non_violation' => $nonViolationCount,
            'violation'     => $violationCount,
            'total'         => $total,
            'percentile_violation'     => $percentileViolation,
            'percentile_non_violation' => $percentileNonViolation,
        ];
    }

    public function _getViolationBasedOnBrands($params, $usePagination = true)
    {
        $companyBrandModel = new CompanyBrand();
        $list = $companyBrandModel->analize($params, $usePagination);
        return $list;
    }

    public function _getViolationBasedOnCode($params, $usePagination = true)
    {
        $violationCodeModel = new ViolationCode();
        $list = $violationCodeModel->analize($params, $usePagination);
        return $list;
    }

    public function exportAnalysis($params, $fileName, $renderType = ExportService::RENDER_TREAM_TO_BROWSER) {
        $generalData = $this->_getGeneralData($params);
        $brandData = $this->_getViolationBasedOnBrands($params, $usePagination = false);
        $codeData = $this->_getViolationBasedOnCode($params, $usePagination = false);

        // Sheet General data
        $titles = [
            'Unable to detect',
            'Violation',
            'Violations detected/submitted',
            'Total articles',
            'Percentile of Violation',
            'Percentile of Unable to detect',
            'Percentile of violations detected/submitted'
        ];
        $exportData = [
            [
                $generalData['non_violation'],
                $generalData['violation'],
                $generalData['total'] - ($generalData['violation'] + $generalData['non_violation']),
                $generalData['total'],
                $generalData['percentile_violation'].'%',
                $generalData['percentile_non_violation'].'%',
                $generalData['total'] > 0 ? 100 - ( $generalData['percentile_violation'] +  $generalData['percentile_non_violation']).'%' : '0%',
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
        return ExportService::exportExcelFile($sheets, $fileName ,$renderType);
    }

      // ============================================ //
     // ======= CRONJOB EXPORT DATA EVERY WEEK ===== //
    // =========================================== //
    public function exportDataEveryWeek() {
        $now = time();
        $startDate =  date('m-d-Y', strtotime('-7 days'));
        $endDate = date('m-d-Y', $now);
        $params = [
            'start_date' => $startDate,
            'end_date'   => $endDate
        ];
        $fileName = 'analysis-export-'.$startDate.'--'.$endDate;
        $this->exportAnalysis($params, $fileName, ExportService::RENDER_TO_FILE);

        $fileWithExtension = $fileName.ExportService::EXCEL_EXT;
        $fileWithPath = public_path($fileWithExtension);

        $data = $params;
        $listReceivers = Admin::where('role', Admin::ROLE_OPERATOR )->get();
        if($listReceivers) {
            foreach ($listReceivers as $key => $receiver) {
                Mail::to($receiver->email)->queue(new AnalyticWeeklyReport($data, $fileWithPath));
            }
        }

        unlink($fileWithPath);
    }

      // ============================================ //
     // ================== CHARTS =================== //
    // =========================================== //
    public function violationBasedCountries() {
        $countryModel = new Country();
        $data = $countryModel->violationByCountries();
        $countryData = [];
        foreach ($data as $key => $value) {
            $countryData[] = [
                'country'        => $value->country,
                'total_articles' => $value->total_articles
            ];
        }
        return $countryData;
    }
}

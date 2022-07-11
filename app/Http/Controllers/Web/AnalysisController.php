<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\AnalyticService;
use Illuminate\Support\Facades\Auth;

class AnalysisController extends Controller
{
    public $analyticService;

    function __construct() {
        $this->analyticService = new AnalyticService;
    }

    public function index(Request $request) {
        $params = $request->all();
        if(isset($params['export']) && $params['export'] == true  && Auth::check()) {
            return $this->analyticService->exportAnalysis($params, 'analysis-export');
        }
        return view('pages/analysis/index');
    }

      // ============================================ //
     // ================== AJAX ==================== //
    // =========================================== //
    public function getGeneralData(Request $request)
    {
        $generalData = $this->analyticService->_getGeneralData($request->all());
        return view('pages/analysis/general', compact('generalData'));
    }

    public function getViolationBasedOnBrands(Request $request)
    {
        $brandData = $this->analyticService->_getViolationBasedOnBrands($request->all());
        return view('pages/analysis/vio_based_brand_table', compact('brandData'));
    }

    public function getViolationBasedOnCode(Request $request)
    {
        $codeData = $this->analyticService->_getViolationBasedOnCode($request->all());
        return view('pages/analysis/vio_based_code_table', compact('codeData'));
    }
}

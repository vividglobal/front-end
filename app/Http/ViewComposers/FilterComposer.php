<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Mongo\CompanyBrand;
use App\Models\Mongo\Country;
use App\Models\Mongo\ViolationCode;
use App\Models\Mongo\ViolationType;

class FilterComposer
{
    protected $brands;
    protected $countries;
    protected $violationCode;
    protected $violationTypes;
    /**
     * Create a movie composer.
    *
    * @return void
    */
    public function __construct()
    {
        $this->brands = CompanyBrand::all();
        $this->countries = Country::all();
        $this->violationCode = ViolationCode::all();
        $this->violationTypes = ViolationType::all();
    }

    /**
     * Bind data to the view.
    *
    * @param  View  $view
    * @return void
    */
    public function compose(View $view)
    {
        $view->with('brands', $this->brands);
    }
}

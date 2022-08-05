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
        $this->brands = CompanyBrand::orderBy('name', ASC)->get();
        $this->countries = Country::orderBy('name', ASC)->get();
        $this->violationCode = ViolationCode::orderBy('name', ASC)->get();
        $this->violationTypes = ViolationType::orderBy('name', ASC)->get();
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
        $view->with('countries', $this->countries);
        $view->with('violationCode', $this->violationCode);
        $view->with('violationTypes', $this->violationTypes);
    }
}

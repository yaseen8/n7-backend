<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AppCompanyListModel\CompanyList;

class CompanyListController extends Controller
{
    protected $model;
    public function __construct(CompanyList $model)
    {
       $this->model=$model;
    //    $this->middleware('auth');
    }

    public function get_company_list(Request $request)
    {
        $company = CompanyList::get();
        return response()->json($company, 200);
    }
}

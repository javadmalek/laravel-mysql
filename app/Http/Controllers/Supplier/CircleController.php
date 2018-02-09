<?php

namespace App\Http\Controllers\Supplier;

use App\Circle;
use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use Validator, Input, Redirect, Session;
use View;


class CircleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userType = Auth::user()->type;
        if ($userType == 'SUPPLIER') {
            $companies = Company::all();
            $myCircle = Auth::user()->company->myCircle;

            return View::make('circles.supplier.index', ['circles' => $myCircle, 'companies' => $companies]);
        } else if ($userType == 'PURCHASER')
            return response()->view('errors.403');
    }

    public function filter(Request $request)
    {
        $companies = Company::all();
        $company = Auth::user()->company;
        $companyIds = Input::get('_dst_company_id');
        $filteredCompanies = Company::findMany($companyIds);

        return View::make('circles.supplier.filter', ['_src_company' => $company, 'companies' => $companies, 'filteredCompanies' => $filteredCompanies]);
    }

    public function status($_circle_id, $_status)
    {
        $circle = new Circle();
        $circle = Circle::find($_circle_id);

        switch ($_status)
        {
            case 'unfollow':
                $circle->delete();
                break;
            case 'cancelrequest':
                $circle->delete();
                break;
            case 'accept':
                $circle->status = 'ACCEPTED';
                $circle->save();

                $mycircle = new Circle();
                $mycircle->_src_company_id = $circle->_dst_company_id;
                $mycircle->_dst_company_id = $circle->_src_company_id;
                $mycircle->status = $circle->status;
                $mycircle->save();

                break;
        }

        Session::flash('message', 'Successfully Cancel the relation!');
        return Redirect::to('supplier/companies/circles');
    }

    public function request($_dst_company_id)
    {
        $circle = new Circle();
        $circle->_src_company_id = Auth::user()->company->id;
        $circle->_dst_company_id = $_dst_company_id;
        $circle->save();

        Session::flash('message', 'Successfully sent friend request!');
        return Redirect::to('supplier/companies/circles');

    }

    public function receivedRequets()
    {
        $circles = Circle::where('_dst_company_id', '=', Auth::user()->company->id)
            -> where('status','=', 'REQUESTED')
        ->get();

        return View::make('circles.supplier.requests')
            ->with('circles', $circles);
    }
}

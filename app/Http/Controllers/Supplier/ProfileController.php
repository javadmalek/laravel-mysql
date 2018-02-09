<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Company;
use App\Country;
use App\User;

use Validator, Input, Redirect, Session;
use View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userType = Auth::user()->type;
        if ($userType == 'SUPPLIER') {
            $myCompany = Auth::user()->company;

            if ($myCompany) {
                $countries = Country::all()->where('active', 1);
                return View::make('companies.supplier.show')
                    ->with('countries', $countries)
                    ->with('company', $myCompany);
            }
        }
        return response()->view('errors.403');
    }

    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'operation_type' => 'required',
            'subscription_plan_type' => 'required',
            'office_address' => 'required',
            'office_tele' => 'required',
            'contact_person' => 'required',
            'country_id' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('companies/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $company = new Company();
            $company->title = Input::get('title');
            $company->slug = preg_replace('/[^a-z0-9]+/', '-', strtolower(Input::get('web_url')));
            $company->web_url = preg_replace('/[^a-z0-9.]+/', '-', strtolower(Input::get('web_url')));
            $company->operation_type = Input::get('operation_type');

            $company->subscription_plan_type = Input::get('subscription_plan_type');
            $company->co_founder = Input::get('co_founder');
            $company->cto = Input::get('cto');
            $company->ceo = Input::get('ceo');
            $company->founding_year = Input::get('founding_year');
            $company->turnover =  Input::get('turnover');
            $company->vat = Input::get('vat');
            $company->employee_number = Input::get('employee_number');

            $company->country_id = Input::get('country_id');
            $country = Country::find($company->country_id);
            if($country)
                $company->country_name = $country->name;
            $company->office_address = Input::get('office_address');
            $company->office_tele = Input::get('office_tele');
            $company->company_description = Input::get('company_description');
            $company->contact_person = Input::get('contact_person');
            $company->latitude = Input::get('latitude');
            $company->longitude = Input::get('longitude');

            $company->skype = Input::get('skype');
            $company->fb = Input::get('fb');
            $company->in = Input::get('in');
            $company->gplus = Input::get('gplus');
            $company->twitter = Input::get('twitter');
            $company->save();

            // Updating the user data
            User::where('id', Auth::user()->id)
                ->update(['_company_id' => $company->id]);
            Auth::user()->company = $company;

            Session::flash('message', 'Successfully created company!');
            return Redirect::to('supplier/companies');
        }
    }

    public function show()
    {
        // get the company
        $userType = Auth::user()->type;
        if ($userType == 'SUPPLIER') {
            $myCompany = Auth::user()->company;
            if ($myCompany)
                return View::make('companies.supplier.show')->with('company', $myCompany);
        }
        return response()->view('errors.403');
    }

    public function edit()
    {
        $userType = Auth::user()->type;
        if ($userType == 'SUPPLIER') {
            $myCompany = Auth::user()->company;
            if ($myCompany) {
                $countries = Country::all()->where('active', 1);
                return View::make('companies.supplier.edit')
                    ->with('countries', $countries)
                    ->with('company', $myCompany);
            }
        }
        return response()->view('errors.403');
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'title' => 'required',
            'operation_type' => 'required',
            'subscription_plan_type' => 'required',
            'office_address' => 'required',
            'office_tele' => 'required',
            'contact_person' => 'required',
            'country_id' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('supplier/companies/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $company = Company::find($id);
            $company->title = Input::get('title');
            $company->slug = preg_replace('/[^a-z0-9]+/', '-', strtolower(Input::get('web_url')));
            $company->web_url = preg_replace('/[^a-z0-9.]+/', '-', strtolower(Input::get('web_url')));
            $company->operation_type = Input::get('operation_type');

            $company->subscription_plan_type = Input::get('subscription_plan_type');
            $company->co_founder = Input::get('co_founder');
            $company->cto = Input::get('cto');
            $company->ceo = Input::get('ceo');
            $company->founding_year = Input::get('founding_year');
            $company->turnover = Input::get('turnover');
            $company->vat = Input::get('vat');
            $company->employee_number = Input::get('employee_number');

            $company->country_id = Input::get('country_id');
            $country = Country::find($company->country_id);
            if($country)
                $company->country_name = $country->name;
            $company->office_address = Input::get('office_address');
            $company->office_tele = Input::get('office_tele');
            $company->company_description = Input::get('company_description');
            $company->contact_person = Input::get('contact_person');
            $company->latitude = Input::get('latitude');
            $company->longitude = Input::get('longitude');

            $company->skype = Input::get('skype');
            $company->fb = Input::get('fb');
            $company->in = Input::get('in');
            $company->gplus = Input::get('gplus');
            $company->twitter = Input::get('twitter');

            $company->save();

            Auth::user()->company = $company;


            Session::flash('message', 'Successfully updated company!');
            return Redirect::to('supplier/companies');
        }
    }

    public function destroy($id)
    {
        // delete
        $company = Company::find($id);
        $company->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the company!');
        return Redirect::to('supplier/companies');
    }

    public function offersOut()
    {
        $myoffers = Auth::user()->company->offersOut;
        return View::make('offers.supplier.showall', ['offers' => $myoffers, 'filter_key' => '']);
    }

    public function filterOffersOut()
    {
        $filter_key = Input::get('filter_key');
        if ($filter_key != '') {
            $myoffers = Auth::user()->company->offersOut;
            return View::make('offers.supplier.showall', ['offers' => $myoffers, 'filter_key' => $filter_key]);
        } else
            return $this->offersOut();
    }
}

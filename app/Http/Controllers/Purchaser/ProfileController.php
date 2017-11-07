<?php

namespace App\Http\Controllers\Purchaser;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Company;
use App\User;

use Validator, Input, Redirect, Session;
use View;


class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myCompany = Auth::user()->company;
            if ($myCompany)
                return View::make('companies.show')->with('company', $myCompany);
            else
                return View::make('companies.create');
        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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
            'contact_person' => 'required'
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
            return Redirect::to('purchaser/companies');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // get the company
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myCompany = Auth::user()->company;
            if ($myCompany)
                return View::make('companies.show')->with('company', $myCompany);
            else
                return View::make('companies.create');
        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myCompany = Auth::user()->company;
            if ($myCompany)
                return View::make('companies.edit')->with('company', $myCompany);
            else
                return View::make('companies.create');
        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            'operation_type' => 'required',
            'subscription_plan_type' => 'required',
            'office_address' => 'required',
            'office_tele' => 'required',
            'contact_person' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('purchaser/companies/' . $id . '/edit')
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
            return Redirect::to('purchaser/companies');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $company = Company::find($id);
        $company->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the company!');
        return Redirect::to('purchaser/companies');
    }
}

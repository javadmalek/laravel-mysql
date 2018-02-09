<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Company;


use Input, Redirect, Session;
use View;


class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    protected function validator(array $data)
    {
        $rules = array(
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'type' => 'required',
//            '_company_id' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return response()->view('errors.403');
        } else {
            return $validator;
        }
    }

    protected function create(array $data)
    {
        $company = new Company();
        $company->title = '- NAN new user - ' . $data['type'];
        $company->slug = '- NAN new user - ' . $data['name'] . $data['type']. mt_rand(10,100);
        $company->operation_type = $data['type'];
        $company->subscription_plan_type = 'PREMIUM';

        $company->office_address = '';
        $company->office_tele = '';

        $company->company_description = '';
        $company->contact_person = $data['name'];

        $company->co_founder = $data['name'];
        $company->cto = $data['name'];
        $company->ceo = $data['name'];
        $company->founding_year = '2017';
        if($company->save()) {

            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                '_company_id' => $company->id,
                'type' => $data['type'],
            ]);
        }else
            return response()->view('errors.403');

    }
}

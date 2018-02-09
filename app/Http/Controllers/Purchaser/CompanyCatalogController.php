<?php

namespace App\Http\Controllers\Purchaser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\ChannelVariable;
use App\Http\Controllers\Controller;

use App\Company;
use App\CompanyCatalog;
use App\User;

use Validator, Input, Redirect, Session;
use View;

class CompanyCatalogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $catalogs = CompanyCatalog::where([['_company_id', '=', Auth::user()->company->id],])->paginate(10);
        return View::make('catalogs.purchaser.index', ['catalogs' => $catalogs, 'filter_key' => '']);
    }

    public function filter()
    {
        $filter_key = Input::get('filter_key');
        if ($filter_key) {
            $userType = Auth::user()->type;
            if ($userType == 'PURCHASER') {
                $catalogs = CompanyCatalog::where([['_company_id', '=', Auth::user()->company->id],])->paginate(10);
                return View::make('catalogs.purchaser.index', ['catalogs' => $catalogs, 'filter_key' => $filter_key]);
            } else
                return response()->view('errors.403');
        } else
            return $this->index();
    }

    public function create()
    {
        return View::make('catalogs.purchaser.create');
    }

    public function store(Request $request)
    {

        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $rules = array(
                'title' => 'required',
                'type' => 'required',
                'application' => 'required',
                'keywords' => 'required',
                'standards' => 'required',
                'crc' => 'required',
                'price' => 'required',
                'logo' => 'required'
            );
            $validator = Validator::make(Input::all(), $rules);

            // process the login
            if ($validator->fails()) {
                return Redirect::to('/purchaser/companies/catalogs/create')
                    ->withErrors($validator);
            } else {
                $catalog = new CompanyCatalog();
                $catalog->title = Input::get('title');
                $catalog->type = Input::get('type');
                $catalog->application = Input::get('application');
                $catalog->keywords = Input::get('keywords');
                $catalog->standards = Input::get('standards');
                $catalog->crc = Input::get('crc');
                $catalog->price = Input::get('price');
                $catalog->description = Input::get('description');
                $catalog->_company_id = Auth::user()->_company_id;

                $catalog->save();

                if (Input::hasFile('logo')) {
                    $file = Input::file('logo');
                    $filename = md5($file->getClientOriginalName() . time());
                    $filename = str_replace(' ', '_', $filename);
                    $filename .= ('.' . $file->getClientOriginalExtension());

                    Storage::disk('minio')->put('catalogs/' . $catalog->type . '/' . $catalog->id . '/' . $filename, file_get_contents($file));
                    $catalog->logo = $filename;
                } else
                    return Redirect::to('purchaser/companies/catalogs/' . $catalog->id . '/edit')
                        ->withErrors('No file is Selected');

                $catalog->save();

                Session::flash('message', 'Successfully created Catalog!');
                return Redirect::to('purchaser/companies/catalogs/');
            }
        }
        return response()->view('errors.403');
    }

    public function show($id)
    {
        return response()->view('errors.403');
    }

    public function edit($id)
    {
        $catalog = CompanyCatalog::find($id);
        if ($catalog)
            return View::make('catalogs.purchaser.edit')
                ->with('catalog', $catalog);
        else
            return response()->view('errors.403');
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'title' => 'required',
            'type' => 'required',
            'application' => 'required',
            'keywords' => 'required',
            'standards' => 'required',
            'crc' => 'required',
            'price' => 'required');

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('/purchaser/companies/catalogs/' . $id . '/edit')
                ->withErrors($validator);
        } else {
            $catalog = new CompanyCatalog();
            $catalog = CompanyCatalog::where('id', '=', $id)
                ->where('_company_id', Auth::user()->_company_id)->first();

            if ($catalog) {
                $catalog->title = Input::get('title');
                $catalog->type = Input::get('type');
                $catalog->application = Input::get('application');
                $catalog->keywords = Input::get('keywords');
                $catalog->standards = Input::get('standards');
                $catalog->crc = Input::get('crc');
                $catalog->price = Input::get('price');
                $catalog->description = Input::get('description');

                $catalog->save();
                if (Input::hasFile('logo')) {
                    $file = Input::file('logo');
                    $filename = md5($file->getClientOriginalName() . time());
                    $filename = str_replace(' ', '_', $filename);
                    $filename .= ('.' . $file->getClientOriginalExtension());

                    Storage::disk('minio')->put('catalogs/' . $catalog->type . '/' . $catalog->id . '/' . $filename, file_get_contents($file));
                    $catalog->logo = $filename;
                }

                Session::flash('message', 'Successfully updated channel!');
                return Redirect::to('purchaser/companies/catalogs');
            } else
                return response()->view('errors.403');
        }
    }

    public function destroy($id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $catalog = CompanyCatalog::where('id', $id)
                ->where('_company_id', Auth::user()->_company_id)->first();
            if ($catalog) {
                $catalog->delete();

                // TODo: Delete images from MINIO S3

                Session::flash('message', 'Successfully deleted the channel!');
                return Redirect::to('purchaser/companies/catalogs');
            } else
                return response()->view('errors.403');
        } else
            return response()->view('errors.403');
    }
}
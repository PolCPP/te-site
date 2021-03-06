<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Auth\RegisterController as SiteRegisterController;
use App\Models\User;
use App\Models\Institution;
use Illuminate\Auth\Events\Registered;
use Auth;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends SiteRegisterController
{

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function registerUser(Request $request)
    {
        $val = parent::validator($request->all());
        if ($val->passes()) {
            event(new Registered($user = parent::create($request->all())));
            $data = array( 'success' => true);
            return $data;
        } else {
            return response()->json($val->errors(), 400);
        }
    }

    public function getInstitutions(Request $request)
    {
        if ($request->has('name')) {
            return User::where('userable_type', Institution::class)->select('id','name')->where('name', 'like', '%' . $request->input('name') . '%')->get() ;
        }

        return User::where('userable_type', Institution::class)->select('id','name')->get();

    }
}

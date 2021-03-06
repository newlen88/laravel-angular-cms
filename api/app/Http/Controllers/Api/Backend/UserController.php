<?php namespace App\Http\Controllers\Api\Backend;

use Input, Request, Validator, App, UserAuth, Route;

class UserController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return App::make('App\Http\Controllers\Api\UserController')->show(UserAuth::user()->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return Response
     */
    public function update()
    {
        //deny edit some fields
        $input = Request::input();
        foreach (['activation_code', 'active'] as $key => $value) {
            if (isset($input[$value])) {
                $input[$value] = null;
            }
        }
        Request::merge($input);

        return App::make('App\Http\Controllers\Api\UserController')->update(UserAuth::user()->id);

    }
}
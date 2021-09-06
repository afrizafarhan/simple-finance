<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()
        ->json(['data' => Account::join(Account::$tableNameJoin[0], Account::$tableName.'.id_user','=', Account::$tableNameJoin[0].'.id')
        ->where('status','=',1)
        ->get([Account::$tableName.'.id', Account::$tableNameJoin[0].'.name', Account::$tableName.'.balance', Account::$tableNameJoin[0].'.status'])]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $account = new Account();
            $account->create($request->validate([
                'id_user' => 'required',
                'balance' => 'required',
            ]));
            return response()->json(['msg' => 'SUCCESS_ADD_NEW_ACCOUNT']);
        }catch(\Throwable $e){
            return response()->json(['msg' => 'INTERNAL_SERVER_ERROR'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        
        return response()
        ->json(['data' => Account::join(Account::$tableNameJoin[0], Account::$tableName.'.id_user','=', Account::$tableNameJoin[0].'.id')
        ->where('status','=',1)
        ->where('id_user', $account->id_user)
        ->get([Account::$tableName.'.id', Account::$tableNameJoin[0].'.name', Account::$tableName.'.balance', Account::$tableNameJoin[0].'.status'])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}

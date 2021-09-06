<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => Transaction::leftJoin(Transaction::$tableNameJoins[0], Transaction::$tableName.'.id_account', '=', Transaction::$tableNameJoins[0].'.id')->leftJoin(Transaction::$tableNameJoins[2], Transaction::$tableNameJoins[0].'.id_user', '=', Transaction::$tableNameJoins[2].'.id')->leftJoin(Transaction::$tableNameJoins[1], Transaction::$tableName.'.id_type_transaction', '=', Transaction::$tableNameJoins[1].'.id')->get([
            Transaction::$tableName.'.id',
            Transaction::$tableNameJoins[2].'.name as name_account',
            Transaction::$tableNameJoins[1].'.name as name_type_transaction',
            Transaction::$tableName.'.nominal_in_out'
        ])]);
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
            DB::beginTransaction();
            $transaction = new Transaction();
            $transaction->create($request->validate([
                'id_account' => 'required',
                'nominal_in_out' => 'required',
                'id_type_transaction' => 'required',
                'status' => 'required',
            ]));
            
            $account = Account::find($request->id_account);
            if(in_array($request->id_type_transaction, Transaction::$typeTransaction['BALANCE_INC'])){
                $account->balance += $request->nominal_in_out;
            }else{
                $account->balance -= $request->nominal_in_out;
            }
            
            $account->save();
            DB::commit();

            return response()->json(['msg' => 'SUCCESS_ADD_NEW_TRANSACTIONS'], 200);
        }catch(\Throwable $e){
            DB::rollback();
            return response()->json(['msg' => 'INVALID_INTERNAL_ERROR'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {

        return response()->json(['data' => Transaction::leftJoin(Transaction::$tableNameJoins[0], Transaction::$tableName.'.id_account', '=', Transaction::$tableNameJoins[0].'.id')->leftJoin(Transaction::$tableNameJoins[2], Transaction::$tableNameJoins[0].'.id_user', '=', Transaction::$tableNameJoins[2].'.id')->leftJoin(Transaction::$tableNameJoins[1], Transaction::$tableName.'.id_type_transaction', '=', Transaction::$tableNameJoins[1].'.id')->where('id_account', $transaction->id_account)->get([
            Transaction::$tableName.'.id',
            Transaction::$tableNameJoins[2].'.name as name_account',
            Transaction::$tableNameJoins[1].'.name as name_type_transaction',
            Transaction::$tableName.'.nominal_in_out'
        ])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

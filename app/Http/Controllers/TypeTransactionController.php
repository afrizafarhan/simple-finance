<?php

namespace App\Http\Controllers;

use App\Models\TypeTransaction;
use Illuminate\Http\Request;

class TypeTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['data' => TypeTransaction::all()]);
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
            $typeTransaction = new TypeTransaction();
            $typeTransaction->create($request->validate([
                'name' => 'required'
            ]));
            return response()->json(['msg' => 'SUCCESS_ADD_TYPE_TRANSACTION']);
        }catch(\Throwable $e){
            return response()->json(['msg' => 'INVALID_INTERNAL_ERROR'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeTransaction  $typeTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(TypeTransaction $typeTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeTransaction  $typeTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeTransaction $typeTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeTransaction  $typeTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeTransaction $typeTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeTransaction  $typeTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(TypeTransaction $typeTransaction)
    {
        //
    }
}

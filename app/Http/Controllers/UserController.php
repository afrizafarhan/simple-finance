<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Region;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataResponse = [];
        foreach (User::all() as $data) {
            array_push($dataResponse, [
                "id" => $data->id,
                "name" => $data->name,
                "email" => $data->email,
                "birthdate" => $data->birthdate,
                "num_phone" => $data->num_phone,
                "address" => $data->address,
                "province" => Region::find($data->id_province)->name,
                "district_city" => Region::find($data->id_district_city)->name,
                "sub_district" => Region::find($data->id_sub_district)->name,
                "urban_village" => Region::find($data->id_urban_village)->name,
                "status" => $data->status,
            ]);
        }
        return response()->json(['data' => $dataResponse]);
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
        try {
            $user = new User();
            $user->create($request->validate([
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'birthdate' => 'required',
                'num_phone' => 'required',
                'address' => 'required',
                'id_province' => 'required',
                'id_district_city' => 'required',
                'id_sub_district' => 'required',
                'id_urban_village' => 'required'
            ]));
            return response()->json(['msg' => 'SUCCESS_ADD_NEW_USER']);
        } catch (\Throwable $e) {
            return response()->json(['msg' => 'INTERNAL_SERVER_ERROR'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->json(['data' => [
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "birthdate" => $user->birthdate,
            "num_phone" => $user->num_phone,
            "address" => $user->address,
            "province" => Region::find($user->id_province)->name,
            "district_city" => Region::find($user->id_district_city)->name,
            "sub_district" => Region::find($user->id_sub_district)->name,
            "urban_village" => Region::find($user->id_urban_village)->name,
            "status" => $user->status,
        ]]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {

            $request->validate([
                'name' => 'required',
                'birthdate' => 'required',
                'num_phone' => 'required',
                'address' => 'required',
                'id_province' => 'required',
                'id_district_city' => 'required',
                'id_sub_district' => 'required',
                'id_urban_village' => 'required'
            ]);
            $user->name = $request->name;
            $user->birthdate = $request->birthdate;
            $user->num_phone = $request->num_phone;
            $user->address = $request->address;
            $user->id_province = $request->id_province;
            $user->id_district_city = $request->id_district_city;
            $user->id_sub_district = $request->id_sub_district;
            $user->id_urban_village = $request->id_urban_village;
            $user->save();

            return response()->json(['msg' => 'SUCCESS_UPDATE_USER', 'data' => [
                'name' => $user->name,
            ]]);
        } catch (\Throwable $e) {
            return response()->json(['msg' => 'INTERNAL_SERVER_ERROR'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function nonActiveUser(User $user)
    {
        try {
            $user->status = 0;
            $user->save();
            return response()->json(['msg' => 'SUCCESS_NON_ACTIVE_USER']);
        } catch (\Throwable $e) {
            return response()->json(['msg' => $e->getMessage()], 500);
        }
    }
}

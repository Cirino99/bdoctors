<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = DB::table('users')
            ->join('specialization_user', 'users.id', '=', 'specialization_user.user_id')
            ->join('specializations', 'specialization_user.specialization_id', '=', 'specializations.id')
            ->join('sponsorship_user', 'users.id', '=', 'sponsorship_user.user_id')
            ->join('sponsorships', 'sponsorship_user.sponsorship_id', '=', 'sponsorships.id')
            ->where('sponsorship_user.ending_date', '>', date('Y-m-d H:i:s'))
            ->select('users.id', 'users.name', 'users.lastname', 'sponsorship_user.ending_date', 'specializations.name as specialization')
            ->get();
        return response()->json([
            'success'   => true,
            'result'    => $doctors,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

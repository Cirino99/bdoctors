<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    private function fixImageUrl($imgPath)
    {
        return $imgPath ? asset('/storage/' . $imgPath) : null;
    }

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

    public function show($id)
    {
        $doctor = User::with(['specializations'])->where('id', $id)->first();

        if ($doctor) {
            unset($doctor->email_verified_at, $doctor->created_at, $doctor->updated_at);
            foreach ($doctor->specializations as $specialization) {
                unset($specialization->created_at, $specialization->updated_at, $specialization->pivot);
            }
            if ($doctor->image) {
                $doctor->image = $this->fixImageUrl($doctor->image);
            }
            return response()->json([
                'success'   => true,
                'result'    => $doctor
            ]);
        } else {
            return response()->json([
                'success'   => false,
            ]);
        }
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

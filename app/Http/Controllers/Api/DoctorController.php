<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Specialization;

class DoctorController extends Controller
{
    private function fixImageUrl($imgPath)
    {
        return $imgPath ? asset('/storage/' . $imgPath) : null;
    }

    public function index()
    {
        $doctors_ids = DB::table('users')
            ->join('sponsorship_user', 'users.id', '=', 'sponsorship_user.user_id')
            ->where('sponsorship_user.ending_date', '>', date('Y-m-d H:i:s'))
            ->select('users.id')
            ->get();
        $doctors = [];
        foreach ($doctors_ids as $doctor_id) {
            $doctor = User::with(['specializations'])->where('id', $doctor_id->id)->first();
            unset($doctor->email_verified_at, $doctor->created_at, $doctor->updated_at);
            foreach ($doctor->specializations as $specialization) {
                unset($specialization->created_at, $specialization->updated_at, $specialization->pivot);
            }
            $doctor->photo = $this->fixImageUrl($doctor->photo);
            array_push($doctors, $doctor);
        }
        $specializations = Specialization::get()->pluck('name');

        return response()->json([
            'success'   => true,
            'result'    => $doctors,
            'specializations' => $specializations
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
            $doctor->photo = $this->fixImageUrl($doctor->photo);
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
}

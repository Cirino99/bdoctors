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

    public function specialization(Request $request)
    {
        $specialization = $request->get('specialization');
        $specializations = DB::table('specializations')
            ->where('name', 'like', '%' . $specialization . '%')
            ->select('id', 'name')
            ->get();
        if ($specializations) {
            return response()->json([
                'success'   => true,
                'result'    => $specializations
            ]);
        } else {
            return response()->json([
                'success'   => false,
            ]);
        }
    }

    public function search(Request $request)
    {
        $specialization = $request->get('specialization');
        $city = $request->get('city');
        //$search = User::with(['specializations'])->where('specializations', 'like', $data)->first();
        //$search = User::where('id', 'like', "%{$data}%")->get();
        if ($city == 'all') {
            $doctors_ids = DB::table('users')
                ->join('specialization_user', 'users.id', '=', 'specialization_user.user_id')
                ->where('specialization_user.specialization_id', 'like', $specialization)
                ->select('users.id')
                ->get();
        } else {
            $doctors_ids = DB::table('users')
                ->join('specialization_user', 'users.id', '=', 'specialization_user.user_id')
                ->where('users.city', 'like', $city)
                ->where('specialization_user.specialization_id', 'like', $specialization)
                ->select('users.id')
                ->get();
        }

        //dump($specialization, $city, $doctors_ids);
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
        if ($doctors) {
            return response()->json([
                'success'   => true,
                'result'    => $doctors
            ]);
        } else {
            return response()->json([
                'success'   => false,
            ]);
        }
    }

    public function city(Request $request)
    {
        $city = $request->get('city');
        $citys = DB::table('users')
            ->where('city', 'like', '%' . $city . '%')
            ->groupBy('city')
            ->select('city')
            ->get();
        if ($citys) {
            return response()->json([
                'success'   => true,
                'result'    => $citys
            ]);
        } else {
            return response()->json([
                'success'   => false,
            ]);
        }
    }
}

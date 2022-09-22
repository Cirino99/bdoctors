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
        $doctors = User::with(['specializations'])->whereHas('sponsorships', function ($q) {
            $q->where('ending_date', '>', date('Y-m-d H:i:s'));
        })->limit(4)->inRandomOrder()->get();
        foreach ($doctors as $doctor) {
            $doctor->vote = $doctor->reviews->avg('vote');
            unset($doctor->email_verified_at, $doctor->created_at, $doctor->updated_at);
            foreach ($doctor->specializations as $specialization) {
                unset($specialization->created_at, $specialization->updated_at, $specialization->pivot);
            }
            $doctor->photo = $this->fixImageUrl($doctor->photo);
        }
        return response()->json([
            'success'   => true,
            'result'    => $doctors
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
        $reviews = $request->get('reviews');
        $vote = $request->get('vote');
        if ($city == 'all') {
            $doctors_sponsorship = User::with(['specializations'])->whereHas('specializations', function ($q) use ($specialization) {
                $q->where('specialization_id', 'like', $specialization);
            })->whereHas('sponsorships', function ($q) {
                $q->where('ending_date', '>', date('Y-m-d H:i:s'));
            })->withCount('reviews')
                ->having('reviews_count', '>=', $reviews)
                ->get();
            $doctors = User::with(['specializations'])->whereHas('specializations', function ($q) use ($specialization) {
                $q->where('specialization_id', 'like', $specialization);
            })->withCount('reviews')
                ->having('reviews_count', '>=', $reviews)
                ->get();
        } else {
            $doctors = User::with(['specializations'])->whereHas('specializations', function ($q) use ($specialization) {
                $q->where('specialization_id', 'like', $specialization);
            })->where('city', 'like', $city)
                ->withCount('reviews')
                ->having('reviews_count', '>=', $reviews)
                ->get();
        }
        foreach ($doctors_sponsorship as $i => $doctor) {
            $doctor->vote = $doctor->reviews->avg('vote');
            if ($vote > 0) {
                if ($doctor->vote >= $vote) {
                    unset($doctor->email_verified_at, $doctor->created_at, $doctor->updated_at, $doctor->reviews);
                    foreach ($doctor->specializations as $specialization) {
                        unset($specialization->created_at, $specialization->updated_at, $specialization->pivot);
                    }
                    $doctor->photo = $this->fixImageUrl($doctor->photo);
                } else {
                    unset($doctors_sponsorship[$i]);
                }
            } else {
                unset($doctor->email_verified_at, $doctor->created_at, $doctor->updated_at, $doctor->reviews);
                foreach ($doctor->specializations as $specialization) {
                    unset($specialization->created_at, $specialization->updated_at, $specialization->pivot);
                }
                $doctor->photo = $this->fixImageUrl($doctor->photo);
            }
        }
        foreach ($doctors as $i => $doctor) {
            $doctor->vote = $doctor->reviews->avg('vote');
            if ($vote > 0) {
                if ($doctor->vote >= $vote) {
                    unset($doctor->email_verified_at, $doctor->created_at, $doctor->updated_at, $doctor->reviews);
                    foreach ($doctor->specializations as $specialization) {
                        unset($specialization->created_at, $specialization->updated_at, $specialization->pivot);
                    }
                    $doctor->photo = $this->fixImageUrl($doctor->photo);
                } else {
                    unset($doctors[$i]);
                }
            } else {
                unset($doctor->email_verified_at, $doctor->created_at, $doctor->updated_at, $doctor->reviews);
                foreach ($doctor->specializations as $specialization) {
                    unset($specialization->created_at, $specialization->updated_at, $specialization->pivot);
                }
                $doctor->photo = $this->fixImageUrl($doctor->photo);
            }
        }
        if ($doctors) {
            if ($doctors_sponsorship) {
                return response()->json([
                    'success'   => true,
                    'result'    => [$doctors, $doctors_sponsorship]
                ]);
            } else {
                return response()->json([
                    'success'   => true,
                    'result'    => [$doctors, '']
                ]);
            }
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

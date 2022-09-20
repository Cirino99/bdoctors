<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    public function generate(Request $request)
    {
        return response()->json([
            'success'   => true
        ]);
    }

    public function makePayment(Request $request)
    {
        return response()->json([
            'success'   => true
        ]);
    }
}

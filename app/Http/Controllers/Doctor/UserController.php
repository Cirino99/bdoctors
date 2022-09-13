<?php

namespace App\Http\Controllers\Doctor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $validation_rules = [
        'name'              => 'required|string|max:255',
        'lastname'          => 'required|string|max:255',
        // 'email'             => 'required|string|max:255|unique:users|exists:users,email',
        'photo'             => 'string|max:255',
        'phone'             => 'string|max:255',
        'service'           => 'required|string|max:255',
        'address'           => 'required|string|max:255',
        'city'              => 'required|string|max:255',
        'postal_code'       => 'required|integer',
        // 'cv'             =>'text'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);
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
        $request->validate($this->validation_rules);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(int $profile)
    {
        if ($profile === Auth::id()) {
            //$user = User::where('id', $profile);
            $users = User::all();
            foreach ($users as $user) {
                if ($user->id === $profile) {
                    $myUser = $user;
                }
            }
            return view('doctor.profile.show', [
                'user' => $myUser
            ]);
        } else {
            return view('doctor.dashboard');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(int $profile)
    {
        if ($profile === Auth::id()) {
            //$user = User::where('id', $profile);
            $users = User::all();
            foreach ($users as $user) {
                if ($user->id === $profile) {
                    $myUser = $user;
                }
            }
            return view('doctor.profile.edit', [
                'user' => $myUser
            ]);
        } else {
            return view('doctor.dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $profile)
    {
        $request->validate($this->validation_rules);

        $data = $request->all();

        $profile->update($data);

        // $user->save();

        return redirect()->route('doctor.profile.show', $profile);
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
}

<?php

namespace App\Http\Controllers\Doctor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $validation_rules = [
        'name' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'email' => ['required', 'string', 'max:255'],
        'photo' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:255',
        'service' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'postal_code' => 'required|integer',
        'cv' => 'required|min:10|max:500',
        'specializations' => 'required|array',
        'specializations.*' => 'required|integer|exists:specializations,id'
    ];

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
            $specializations = Specialization::all();
            return view('doctor.profile.edit', [
                'user' => $myUser,
                'specializations' => $specializations
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
        if ($profile->id === Auth::id()) {
            $this->validation_rules['email'][] = Rule::unique('users')->ignore($profile->id);
            $request->validate($this->validation_rules);
            $data = $request->all();
            $profile->update($data);
            $profile->specializations()->sync($data['specializations']);

            return redirect()->route('doctor.profile.show', $profile);
        } else {
            return view('doctor.dashboard');
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
}

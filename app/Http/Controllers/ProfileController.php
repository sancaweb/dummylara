<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $dataPage = [
            'pageTitle' => 'User Profile',
            'page' => 'profile',
            'user' => $user
        ];

        return view('profile.index', $dataPage);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $idUser = auth()->user()->id;

        $dataValidate['foto'] = ['image', 'mimes:jpeg,jpg,png,gif,svg', 'max:5000'];
        $dataValidate['nama'] = ['required', 'max:255'];
        $dataValidate['username'] = ['required', 'max:255', 'unique:users,username,' . $idUser];
        $dataValidate['email'] = ['required', 'email', 'unique:users,email,' . $idUser];
        $dataValidate['password'] = ['same:password_confirmation'];
        $dataValidate['password_confirmation'] = ['same:password'];


        $validator = Validator::make($request->all(), $dataValidate);

        if ($validator->fails()) {
            return ResponseFormat::error([
                'errorValidator' => $validator->messages(),
            ], 'Error Validator', 402);
        }

        try {

            DB::beginTransaction();
            $user = User::find($idUser);

            if ($user) {

                $isSuperAdmin = auth()->user()->hasRole('super admin');

                if (!$isSuperAdmin && $request->role == 'super admin') {

                    return ResponseFormat::error([
                        'error' => "User does not have the right roles."
                    ], "User does not have the right roles.", 403);
                }

                if (!$isSuperAdmin && $user->hasRole('super admin')) {
                    return ResponseFormat::error([
                        'error' => "User does not have the right roles."
                    ], "User does not have the right roles.", 403);
                }


                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $foto = $file->store("images/user");
                    Storage::delete($user->foto);
                    $user->foto = $foto;
                }

                $user->name = ucwords($request->nama);
                $user->username = $request->username;
                $user->email = $request->email;

                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }

                $user->save();


                activity('profile_management')->withProperties($user)->performedOn($user)->log('Update Profile');
            } else {
                throw new Exception("Data User tidak ditemukan");
            }

            DB::commit();

            if (auth()->user()->id == $user->id) {
                $self = true;
            } else {
                $self = false;
            }

            return ResponseFormat::success([
                'user' => $user,
                'self' => $self
            ], 'User Updated');
        } catch (Exception $error) {
            DB::rollBack();

            return ResponseFormat::error([
                'error' => $error->getMessage()
            ], "Update User Error", 400);
        }
    }
}

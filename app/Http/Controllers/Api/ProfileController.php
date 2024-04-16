<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function image(UserRequest $request)
    {

        $user = User::findOrFail($request->user()->id);
        if (!is_null($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->image = $request->file('image')->storePublicly('images', 'public');

        $user->save();

        return $user;
    }

    public function show(Request $request)
    {
        return $request->user();
    }

    public function storeInfo(UserRequest $request)
    {
        $user = User::findOrFail($request->user()->id);

        $user->role = $request->input('role');
        $user->phone = $request->input('phone');  
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->national_ID = $request->input('national_ID');

        $user->save();

        return $user;
    }
    public function updateInfo(UserRequest $request)
    {
        $user = User::findOrFail($request->user()->id);

        $user->role = $request->input('role');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address'); 
        $user->gender = $request->input('gender');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->national_id = $request->input('national_id');

        $user->save();

        return $user;
    }
}

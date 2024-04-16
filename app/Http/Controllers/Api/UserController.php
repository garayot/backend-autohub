<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('first_name', 'LIKE', "%{$keyword}%")
                ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                ->orWhere('email', 'LIKE', "%{$keyword}%")
                ->orWhere('national_ID', 'LIKE', "%{$keyword}%");
        }

        return $query->paginate(10);
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
    public function store(UserRequest $request)
    {
        $validated = $request->validated();

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        return User::findOrFail($id);
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
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();

        $user->name = $validated['name'];

        $user->save();

        return $user;
    }
    public function email(UserRequest $request, string $id)
    {

        $user = User::findOrFail($id);
        $validated = $request->validated();

        $user->name = $validated['email'];

        $user->save();

        return $user;
    }
    public function password(UserRequest $request, string $id)
    {
        $validated = $request->validated();

        $user = User::findOrFail($id);
        $user->password = Hash::make($validated['password']);

        $user->save();

        return $user;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return $user;
    }
    public function image(UserRequest $request, string $id)
    {

        $user = User::findOrFail($id);
        if (!is_null($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->image = $request->file('image')->storePublicly('images', 'public');

        $user->save();

        return $user;
    }
}

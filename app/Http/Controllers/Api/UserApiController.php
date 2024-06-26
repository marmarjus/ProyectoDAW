<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json($user, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->filled('username')) {
            $user->username = $request->input('username');
        }
        if ($request->filled('password')) {
            $user->password = $request->input('password');
        }

        $user->save();

        return response()->json($user, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        $user->scores()->delete();
        $user->tasks()->detach();
        $user->sentMessages()->delete();
        $user->receivedMessages()->delete();

        $user->delete();

        return response()->json($user, 204);
    }
}

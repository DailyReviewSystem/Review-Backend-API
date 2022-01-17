<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    public function index() {

    }

    public function store(Request $request) {
    }

    public function show(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    /**
     * @param User $user
     * Remove User
     */
    public function destroy(User $user) {

    }

    /**
     * Get All User un-filled Real Forms
     * @return \Illuminate\Http\JsonResponse
     */
    public function forms() {
//        $user = auth()->user();

        $user = User::first();
        return response()->json( $user->forms );
    }
}

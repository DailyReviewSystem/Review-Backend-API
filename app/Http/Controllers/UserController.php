<?php

namespace App\Http\Controllers;

use App\Http\Resources\RealFormResource;
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function forms() {
        $user = auth()->user();

        return RealFormResource::collection(
            $user->forms()->open()->get()
        );
    }


    /**
     * Return Done Forms
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function done() {
        $user = auth()->user();

        return RealFormResource::collection(
            $user->forms()->done()->get()
        );
    }
}

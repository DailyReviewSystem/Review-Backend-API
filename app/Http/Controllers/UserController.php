<?php

namespace App\Http\Controllers;

use App\Http\Resources\RealFormResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller {
    /**
     * Get All User List ( Only for admin )
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() {
        Gate::authorize("manage-user");
        return UserResource::collection( User::all() );
    }

    /**
     * Admin Can Create New User
     * @return UserResource
     */
    public function store() {
        Gate::authorize("manage-user");

        $info = request()->validate( User::$storeFields );
        $user = User::create( $info );

        return new UserResource( $user );
    }

    /**
     * Get Detail Information About User
     * @param User $user
     * @return UserResource
     */
    public function show(User $user) {
        Gate::authorize("manage-user");
        return new UserResource( $user );
    }

    public function update(User $user) {
    }

    public function destroy(User $user) {
        Gate::authorize("delete-user", $user );

        $user->delete();

        return response()->json([
            "msg" => "success"
        ]);
    }

    /**
     * Get All User Real Forms
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function forms() {
        $user = auth()->user();
        return RealFormResource::collection( $user->forms );
    }
}

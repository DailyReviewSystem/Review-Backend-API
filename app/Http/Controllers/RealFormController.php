<?php

namespace App\Http\Controllers;

use App\Http\Resources\RealFormResource;
use App\Models\RealForm;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RealFormController extends Controller
{
    public function index() {
    }

    public function store(Request $request) {
    }

    public function show(RealForm $realForm) {
        $user = auth()->user();

        if( ! Gate::allows("read-write-form", $realForm) ) {
            abort( 403 );
        }

        return new RealFormResource( $realForm );
    }

    public function edit(RealForm $realForm) {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RealForm  $realForm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RealForm $realForm)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RealForm  $realForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(RealForm $realForm)
    {
        //
    }

    /**
     * Fill Data into form
     * @param RealForm $realForm
     */
    public function fill(RealForm $realForm) {
        if( ! Gate::allows("read-write-form", $realForm) ) {
            abort( 403 );
        }

        $info = request()->validate( $realForm->rules() );
        $value = json_encode($info);

        $realForm->update([
            "done" => true,
            "value" => $value,
        ]);

        return response()->json([
            "value" => $value
        ]);
    }
}

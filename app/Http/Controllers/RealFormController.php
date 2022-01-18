<?php

namespace App\Http\Controllers;

use App\Http\Resources\RealFormResource;
use App\Models\RealForm;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class RealFormController extends Controller
{
    public function index() {
    }

    public function store(Request $request) {
    }

    public function show(RealForm $realForm) {
        $user = auth()->user();

        /**
         * Check Permission
         * Is this your form
         */
        if( $realForm->user->id !== $user->id ) {
            throw new AuthenticationException("It's not your form");
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
        $rules = [];

        $fields = $realForm->fields();

        foreach ( $fields as $field ) {
            $rules[ $field->id ] = join("|", [
                (isset($field->required) && $field->required) ? 'required' : 'nullable'
            ]);
        }

        $info = request()->validate( $rules );
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

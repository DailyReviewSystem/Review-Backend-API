<?php

namespace App\Http\Controllers;

use App\Http\Resources\FormResource;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FormController extends Controller
{

    /**
     * Return All Forms
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() {
        Gate::authorize("access-backend");
        return FormResource::collection( Form::all() );
    }

    /**
     * Create New Form
     * @param Request $request
     */
    public function store(Request $request) {
        $info = request()->validate( Form::$storeFields );
        $form = Form::create( $info );
    }

    /**
     * Get Detail Of Form
     * @param Form $form
     * @return FormResource
     */
    public function show(Form $form) {
        Gate::authorize("access-backend");
        return new FormResource( $form );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Form  $form
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Form $form) {
    }

    public function destroy(Form $form)
    {
        //
    }
}

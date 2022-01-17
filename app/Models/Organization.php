<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    /**
     * An Organization Can Have One Admin
     */
    public function admin() {
        return $this->hasOne( User::class );
    }

    /**
     * An Organization Can have many User
     */
    public function users() {
        return $this->belongsToMany( User::class );
    }

    /**
     * An Organization Can have multiple forms
     */
    public function forms() {
        return $this->belongsToMany( Form::class );
    }

    /**
     * Accept User As Organization Member
     * @param User $user
     */
    public function accept( User $user ) {
        $this->users()->attach( $user );
    }

    /**
     * Register New Form to Org
     * @param Form $form
     */
    public function register( Form $form ) {
        $this->forms()->attach( $form );
    }
}

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
}

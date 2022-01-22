<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    /**
     * Fields That Need when create a form
     * @var array
     */
    public static $storeFields = [

    ];

    /**
     * A form can have one creator
     */
    public function creator() {
        return $this->belongsTo( User::class );
    }

    /**
     * A form is able to being used by multiple organizations
     */
    public function organizations() {
        return $this->belongsToMany( Organization::class );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealForm extends Model
{
    use HasFactory;

    /**
     * Get User Responsible for this RealForm
     */
    public function user() {
        return $this->belongsTo( User::class );
    }

    /**
     * Get Form Spec of this Real Form
     */
    public function form() {
        return $this->belongsTo( Form::class );
    }
}

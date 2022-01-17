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

    /**
     * Get Active Forms
     */
    public function scopeOpen($query) {
        return $query->where("done", "<>", 1);
    }

    /**
     * Get Done Forms
     */
    public function scopeDone($query) {
        return $query->where("done", 1);
    }
}

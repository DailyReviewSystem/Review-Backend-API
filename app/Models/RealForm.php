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

    /**
     * Get Week Name of current real-form's date
     */
    public function getWeekAttribute() {
        return "八";
    }

    public function isVariable( $str ) {
        return $str[ 0 ] === "@" && $str[ strlen($str) - 1 ] === "@";
    }

    /**
     * Get Form Spec && Fill Automatic Data
     */
    public function fields() {
        $fields = json_decode($this->form->fields);

        foreach ( $fields as $field ) {
            if( isset( $field->value ) &&
                $this->isVariable( $field->value )
            ) {
                $key = trim($field->value, "@");
                $field->value = isset( $this[ $key ] ) ? $this[ $key ] : '';
            }
        }

        return $fields;
    }
}

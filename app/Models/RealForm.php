<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealForm extends Model
{
    use HasFactory;
    protected $fillable = ["value", "done"];

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
        $value = json_decode($this->value);

        foreach ( $fields as $field ) {
            if( isset( $field->value ) &&
                $this->isVariable( $field->value )
            ) {
                $key = trim($field->value, "@");
                $field->value = isset( $this[ $key ] ) ? $this[ $key ] : '';
            }

            if( isset($value->{$field->id} ) ) {
                $field->value = $value->{$field->id};
            }
        }

        return $fields;
    }

    /**
     * Get Validate Rule Based on fields
     * @return array
     */
    public function rules() {
        $rules = [];

        $fields = $this->fields();

        foreach ( $fields as $field ) {
            $rules[ $field->id ] = join("|", [
                (isset($field->required) && $field->required) ? 'required' : 'nullable'
            ]);
        }

        return $rules;
    }
}

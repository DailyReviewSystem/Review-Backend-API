<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Fields Require to create a user
     * @var string[]
     */
    public static $storeFields = [
        "username" => "required",
        "display_name" => "required",
        "email" => "required",
        "password" => "required",
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * An user can belongs to many organizations
     */
    public function organizations() {
        return $this->belongsTo( Organization::class );
    }

    /**
     * An User can control many organizations
     */
    public function controllingOrganizations() {
        return $this->hasMany( Organization::class, "admin_id" );
    }

    /**
     * Get User's real forms
     */
    public function forms() {
        return $this->hasMany( RealForm::class );
    }
}

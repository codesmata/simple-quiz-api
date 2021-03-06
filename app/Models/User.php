<?php

namespace QUIZ\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class User
 * @package QUIZ\Models
 * @version December 6, 2017, 2:09 pm UTC
 */
class User extends Authenticatable
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public $fillable = [
        'first_name',
        'last_name',
        'password',
        'email',
        'profile_pic'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'last_name' => 'string',
        'password' => 'string',
        'email' => 'string',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function getProfilePicAttribute($value)
    {
        return config('app.url').'/images/profile_pic/'.$value;
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function quizzes()
    {
        return $this->hasMany('QUIZ\Models\Quizzes', 'user_id', 'id');
    }
}

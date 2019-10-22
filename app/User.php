<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [
        'username', 'role_id'
    ];
    public function role()
    {
        return $this->belongsTo('App\UserRole');
    }
}

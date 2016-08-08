<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;

    protected $table = 'users';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];

    public function networks()
    {
        return $this->belongsToMany('App\Models\Network');
    }

    public function nodes()
    {
        return $this->belongsToMany('App\Models\Node');
    }
}

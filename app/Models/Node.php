<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $table = 'nodes';
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}

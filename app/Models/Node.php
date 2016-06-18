<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $table = 'nodes';
    protected $guarded = ['id'];
    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
        'id' => 'integer'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}

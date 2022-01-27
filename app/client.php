<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    //

    protected $guarded = [];

    public function user()
    {
        return $this->belongToMany(User::class);
    }
    
}

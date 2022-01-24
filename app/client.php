<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    //

    public function client()
     {
         return $this->hasOne(client::class, 'clientId', 'id');
     }
}

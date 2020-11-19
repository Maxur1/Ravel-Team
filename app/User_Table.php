<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Table extends Model
{
    protected $fillable = [
        'name', 'email','rol', 'password',
       ];
}

<?php

namespace App\Models;

use App\Models\Backend;
use App\User;

class Role extends Backend
{
    public function users()
    {
    	return $this->hasMany(User::class,'role_id');
    }
}

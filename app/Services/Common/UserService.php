<?php

namespace App\Services\Common;

use App\Models\User;
use PDF;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserService
{


    public function getLatestUser(){
        return User::latest()->get();
    }

}

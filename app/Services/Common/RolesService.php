<?php

namespace App\Services\Common;

use PDF;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesService
{


    public function __construct()
    {

    }

    public function getAllRoles(){
        return Role::all();
    }

    public function getAllLatestPermissions(){
        return Permission::latest()->get();
    }

    public function roleUpdateOrCreate($roleName){
        return Role::updateOrCreate([
            'name' => $roleName,
        ]);

    }

    public function roleHasPermissions($role, $permissions){
        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }

    }

    public function roleFindById($id){
        return Role::findById($id);
    }

    public function roleDeleteById($role){
        $role = $this->roleFindById($id);
        if($role){
            $role->delete();
            return true;
        }
        return false;
    }

    public function modelHasRoleAssign($user, $role){
        $user->syncRoles($role);
    }

    public function modelRolesDetach($user){
        //user assign role delete
        $user->roles()->detach();
    }

    public function modeHasAllRoles($user){
        return $user->roles;
    }

}

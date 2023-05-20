<?php

namespace App\Services\Common;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Auth;

class UserService
{
    public $rolesService;
    public function __construct( RolesService $rolesService)
    {
        $this->rolesService = $rolesService;
    }
    public function getLatestUser(){
        return User::latest()->get();
    }

    public function get($id){
        return User::find($id);
    }

    public function storeOrUpdate($data, $id=null){
        try {
            if($data['password'] == null){
                unset($data['password']);
            }else{
                $data['password'] = Hash::make($data['password']);
            }
            request()->isMethod('PUT') ?
            $data['updated_by'] = Auth::id()
            : $data['created_by'] = Auth::id();
            // dd($data, $id);
            //conditional wise user update or create
            $user = $this->userUpdateOrCreate($data, $id);
            // dd($user);
            if(isset($data['role']) && !is_null($data['role']) ){
                //user role assign
                $this->rolesService->modelHasRoleAssign($user, $data['role']) ;
            }else{
                //model exiisting roles
                $modelHasRoles =  $this->rolesService->modeHasAllRoles($user) ;
                //user role delete
                if(count($modelHasRoles) > 0){
                    $this->rolesService->modelRolesDetach($user) ;
                }
            }

            return true;
        } catch (\Exception $e) {
            dd($e->getMessage());
            //throw $th;
        }
    }

    public function userUpdateOrCreate($data, $id){
        $data = collect($data)->toArray();
        if($id){
            $email = $data['email'];
            unset($data['email']);
            $user = User::updateOrCreate(['email'=>$email],$data);
        }else{
            $user = User::create($data);
        }

        $user->fresh();
        return $user;
    }

}

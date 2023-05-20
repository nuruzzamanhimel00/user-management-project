<?php

namespace Database\Seeders;

use DB;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::updateOrCreate(['name' => 'Super Admin']);
        $editor = Role::updateOrCreate(['name' => 'Editor']);

        DB::table('permissions')->delete();

           //permission array
           $permissions = [
                [
                    'group_name' => 'Dashboard',
                    'permissions' => [
                        'Dashboard View',
                    ]
                ],
                [
                    'group_name' => 'User',
                    'permissions' => [
                        'User List',
                        'User Edit',
                        'User Add',
                        'User Store',
                        'User Update',
                        'User Delete',
                    ]
                ],
                [
                    'group_name' => 'Product',
                    'permissions' => [
                        'Product List',
                        'Product Edit',
                        'Product Add',
                        'Product Store',
                        'Product Update',
                        'Product Delete',
                    ]
                ],
                [
                    'group_name' => 'Roles',
                    'permissions' => [
                        'Roles List',
                        'Roles Edit',
                        'Roles Add',
                        'Roles Store',
                        'Roles Update',
                        'Roles Delete',
                    ]
                ],
            ];
            foreach($permissions as $permission){
                foreach($permission['permissions'] as $pm){
                    $permissionCreate = Permission::create(['name' =>$pm,'group_name'=>$permission['group_name']]);
                    $superAdmin->givePermissionTo($permissionCreate);
                }
            }

            $emails = User::$seederMail;

            foreach ($emails as $key=>$email){
                $user =  User::where('email',$email)->first();
                if($key == 0){
                    $user->assignRole($superAdmin->id);
                }else{
                    $user->assignRole($editor->id);
                }
            }
    }
}

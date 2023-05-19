<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Common\RolesService;

class RoleController extends Controller
{
    protected $rolesService;
    public function __construct(RolesService $rolesService){
        $this->rolesService = $rolesService;
        $this->middleware(function($request, $next){
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->rolesService->getAllRoles();
        set_page_meta('Role List');
        return view("backend.pages.roles.index",compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        set_page_meta('Role Create');
        $permissions = $this->rolesService->getAllLatestPermissions();
        $permission_groups = User::getPermissionGroups();
        // dd($permission_groups);
        return view('backend.pages.roles.create',compact('permissions','permission_groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $role = $this->rolesService->roleUpdateOrCreate($request->name);
            $permissions = $request->permissions;
            if(!empty($permissions)){
                $this->rolesService->roleHasPermissions($role, $permissions);
            }
            DB::commit();
            return redirect()->route('roles.index')->with('success','Role Created Sucessfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('roles.index')->with('error','Something is wrong!!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

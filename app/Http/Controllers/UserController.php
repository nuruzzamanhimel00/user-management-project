<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\Common\RolesService;
use Illuminate\Http\Request;
use App\Services\Common\UserService;
use DB;

class UserController extends Controller
{
    public $userService;
    public $rolesService;
    public function __construct(UserService $userService, RolesService $rolesService)
    {
        $this->userService = $userService;
        $this->rolesService = $rolesService;
    }
    public function index()
    {
        set_page_meta('User List');
        $users = $this->userService->getLatestUser();
        return view('backend.pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        set_page_meta('Create User');
        $roles = $this->rolesService->getAllRoles();
        return view('backend.pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $data = $request->validated();
        try {
            DB::beginTransaction();
            $this->userService->storeOrUpdate($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('users.index')->with('error','Something is wrong!!');
        }
        return redirect()->route('users.index')->with('success','Users Created Sucessfully');

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

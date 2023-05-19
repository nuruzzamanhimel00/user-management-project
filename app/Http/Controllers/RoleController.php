<?php

namespace App\Http\Controllers;

use App\Services\Common\RolesService;

use Illuminate\Http\Request;
use Auth;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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

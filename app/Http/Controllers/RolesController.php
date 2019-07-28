<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Response;

class RolesController extends ApiController
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function permissions($id) {
        $role = Role::findOrFail($id);
        
        return Response::json(
            $role->getAllPermissions(),
            200
        );
    }
}

<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;

class RolesController extends ApiController
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}

<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;

class PermissionsController extends ApiController
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}

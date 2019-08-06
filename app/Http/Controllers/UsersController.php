<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Response;

class UsersController extends ApiController
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(Request $request) {
        try {
            $item = $this->model::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            return Response::json(
                $item,
                201
            );
        } catch (\Exception $e) {
            return Response::json(
                ["message" => $e->getMessage()],
                500
            );
        }
    }
}

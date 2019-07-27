<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class ApiController extends Controller
{
    protected $model;

    public function getAll() {
        return Response::json(
            $this->model::all(),
            200
        );
    }


    public function getById($id) {
        try {
            return Response::json(
                $this->model::findOrFail($id),
                200
            );
        } catch (\Exception $e) {
            return Response::json(
                ["message" => $e->getMessage()],
                500
            );
        }
    }

    public function create(Request $request) {
        try {
            $item = $this->model::create($request->all());
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

    public function update(Request $request, $id) {
        try {
            $item = $this->model::find($id);
            $item->fill($request->all());
            $item->save();

            return Response::json(
                $item,
                200
            );
        } catch (\Exception $e) {
            return Response::json(
                ["message" => $e->getMessage()],
                500
            );
        }
    }

    public function delete($id) {
        try {
            $item = $this->model::findOrFail($id);
            $item->delete();

            return Response::json(
                $item,
                200
            );
        } catch (\Exception $e) {
            return Response::json(
                ["message" => $e->getMessage()],
                500
            );
        }
    }
}

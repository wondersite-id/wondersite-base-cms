<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class ResourceController extends Controller
{
    /**
     * Resource Request API Service
     */
    protected $resourceRequest;

    /**
     * View Path
     */
    protected $viewPath;


    /**
     * Route Path
     */
    protected $routePath;


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.' . $this->viewPath . '.create');
    }

    protected function attachMediaToModel($request, $model, $field, $value)
    {
        if ($request->hasFile($field)) {
            $model->saveImage($field, $value, 'request');
        } else {
            $model->clearMediaCollection(Str::plural($field));
            // TO-DO check for empty request in edit form
        }

        return $model;
    }
}
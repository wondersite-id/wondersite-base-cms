<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Models\SEO;
use Yajra\DataTables\DataTables;

class SEOController extends ResourceController
{
    /**
     * Construct controller
     */
    public function __construct()
    {
        $this->authorizeResource(SEO::class, 'seo');
        $this->viewPath = "seo";
        $this->routePath = "seos";
        view()->share([
            'title' => ucfirst($this->routePath),
            'description' => 'SEO will be used for optimization website on Google search.',
            'routePrefix' => $this->routePath,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SEO::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('model_url', function ($row) {
                    $modelType = Str::replace('App\Models\\', '', $row['model_type']);
                    $routeName = Str::lower(Str::plural($modelType));

                    $showUrl = route('cms.' . $routeName . '.show', $row['model_id']);
                    $modelUrl = '<b><a href="' . $showUrl . '" </a>' . $row['model_type'] . '&nbsp;<i class="mdi mdi-link-variant"></i></b>';
                    return $modelUrl;
                })
                ->addColumn('model_name', function ($row) {
                    return $row->model->name;
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('cms.seos.show', $row['id']);

                    $showButton = $deleteBtn = "";
                    if (Auth::user()->can('view', $row)) {
                        $showButton = '<a href="' . $showUrl . '" class="text-info"><i class="mdi mdi-eye-circle mr-1"></i>Detail</a>';
                    }
                    if (Auth::user()->can('delete', $row)) {
                        $deleteBtn = '<a href="javascript:void(0)" class="text-danger delete-btns" data-toggle="modal" data-target="#deleteModal" data-id="' . $row['id'] . '"><i class="mdi mdi-trash-can mr-1"></i>Delete</a>';
                    }

                    $actionBtn = $showButton.'&nbsp;&nbsp;'.$deleteBtn;
                    return $actionBtn;
                })
                ->rawColumns(['model_url', 'action'])
                ->make(true);
        }

        return view('cms.' . $this->viewPath . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SEO $seo)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $seo]);
    }
}
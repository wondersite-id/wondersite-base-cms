<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Interfaces\SettingRepositoryInterface;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class SettingController extends ResourceController
{
    private SettingRepositoryInterface $repository;

    /**
     * Construct controller
     */
    public function __construct(SettingRepositoryInterface $repo)
    {
        $this->repository = $repo;
        $this->viewPath = "settings";
        $this->routePath = "utilities";
        view()->share([
            'title' => ucfirst($this->routePath),
            'description' => 'Utilities will be used for content management in homepage, footer and other setting of related website.',
            'routePrefix' => $this->routePath,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->getByType($request->get('type'));
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('form_type', '{{ ucfirst($form_type) }}')
                ->addColumn('action', function ($row) {
                    $showUrl = route('utilities.show', $row['id']);
                    $actionBtn = '<a href="' . $showUrl . '" class="text-info"><i class="mdi mdi-eye-circle mr-1"></i>Detail</a>&nbsp;&nbsp;</center>';
                    return $actionBtn;
                })
                ->rawColumns(['description', 'published', 'sequence_number', 'image', 'action'])
                ->make(true);
        }

        return view('cms.' . $this->viewPath . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $utility)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $utility]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $utility)
    {
        return view('cms.' . $this->viewPath . '.edit', ['model' => $utility]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $utility)
    {
        $data = $request->validated();
        // wysiwyg, text, textarea, image, switch

        if ($utility->form_type == 'switch') {
            if (!Arr::exists($data, 'value')) {
                $data['value'] = 'off';
            }
        } elseif ($utility->form_type == 'image') {
            if (Arr::exists($data, 'value')) {
                $uploadedImage = $data['value'];
                $this->attachMediaToModel($request, $utility, 'value', $uploadedImage);
                $data['value'] = $data['value']->getClientOriginalName();
            }
        }

        $this->repository->update($utility->id, $data);

        session()->flash('message', 'Successfully updated feature data');
        return redirect()->route($this->routePath . '.show', $utility);
    }
}
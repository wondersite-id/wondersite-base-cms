<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUtilityRequest;
use App\Interfaces\UtilityRepositoryInterface;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class UtilityController extends ResourceController
{
    private UtilityRepositoryInterface $repository;

    /**
     * Construct controller
     */
    public function __construct(UtilityRepositoryInterface $repo)
    {
        $this->authorizeResource(Utility::class, 'utility');
        $this->repository = $repo;
        $this->viewPath = "utilities";
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
                    $showUrl = route('cms.utilities.show', $row['id']);

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
                ->rawColumns(['description', 'published', 'sequence_number', 'image', 'action'])
                ->make(true);
        }

        $type = $request->get('type');
        if ($type == null || !in_array($type, Utility::SETTING_TYPE)) {
            return redirect()->route('cms.' . $this->routePath . '.index', ['type' => 'home']);
        }

        return view('cms.' . $this->viewPath . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Utility $utility)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $utility]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Utility $utility)
    {
        return view('cms.' . $this->viewPath . '.edit', ['model' => $utility]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUtilityRequest $request, Utility $utility)
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
        return redirect()->route('cms.' . $this->routePath . '.show', $utility);
    }

    /**
     * Show the form for showing historical changes the specified resource.
     */
    public function historicalChanges(Utility $utility)
    {
        $this->authorize('view', Auth::user());
        $activities = Activity::whereSubjectType(get_class($utility))
            ->whereSubjectId($utility->id)
            ->orderBy("created_at", "desc")
            ->paginate(10);
        return view('cms.' . $this->viewPath . '.historical-changes', ['model' => $utility, 'activities' => $activities]);
    }
}
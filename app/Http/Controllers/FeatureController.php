<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class FeatureController extends ResourceController
{
    private FeatureRepositoryInterface $repository;

    /**
     * Construct controller
     */
    public function __construct(FeatureRepositoryInterface $repo)
    {
        $this->repository = $repo;
        $this->viewPath = "features";
        $this->routePath = "features";
        view()->share([
            'title' => ucfirst($this->routePath),
            'description' => 'Features will be shown on homepage and feature page. It contains name, description, sequence number and image.',
            'routePrefix' => $this->routePath,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->getAll();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('image', function ($row) {
                    if ($image = $row->getFirstMedia('images')) {
                        $imageHtml = '<img  alt="Image ' . $row->name . '"  src="' . $image->getUrl() . '"/>';
                    } else {
                        $imageHtml = 'No Image Attached';
                    }
                    return $imageHtml;
                })
                ->addColumn('published', function ($row) {
                    if ($row->isPublished()) {
                        $publishHtml = '<span class="badge badge-success">Published</span>';
                    } else {
                        $publishHtml = '<span class="badge badge-secondary">Unpublished</span>';
                    }
                    return $publishHtml;
                })
                ->editColumn('sequence_number', '<center>{{$sequence_number}}</center>')
                ->addColumn('action', function ($row) {
                    $showUrl = route('features.show', $row['id']);
                    $actionBtn = '<a href="' . $showUrl . '" class="text-info"><i class="mdi mdi-eye-circle mr-1"></i>Detail</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="text-danger delete-btns" data-toggle="modal" data-target="#deleteModal" data-id="' . $row['id'] . '"><i class="mdi mdi-trash-can mr-1"></i>Delete</a></center>';
                    return $actionBtn;
                })
                ->rawColumns(['description', 'published', 'sequence_number', 'image', 'action'])
                ->make(true);
        }

        return view('cms.' . $this->viewPath . '.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFeatureRequest $request)
    {
        $data = $request->validated();

        $uploadedImage = $data['image'];
        $data['image'] = $data['image']->getClientOriginalName();

        if (Arr::exists($data, 'published_at')) {
            $data['published_at'] = Carbon::now();
        } else {
            $data['published_at'] = null;
        }

        $feature = $this->repository->create($data);
        $this->attachMediaToModel($request, $feature, 'image', $uploadedImage);

        session()->flash('message', 'Successfully saved new feature data');
        return redirect()->route($this->routePath . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $feature]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('cms.' . $this->viewPath . '.edit', ['model' => $feature]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFeatureRequest $request, Feature $feature)
    {
        $data = $request->validated();

        if (Arr::exists($data, 'image')) {
            $uploadedImage = $data['image'];
            $this->attachMediaToModel($request, $feature, 'image', $uploadedImage);
            $data['image'] = $data['image']->getClientOriginalName();
        }

        if (Arr::exists($data, 'published_at')) {
            $data['published_at'] = Carbon::now();
        } else {
            $data['published_at'] = null;
        }

        $this->repository->update($feature->id, $data);

        session()->flash('message', 'Successfully updated feature data');
        return redirect()->route($this->routePath . '.show', $feature);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $this->repository->delete($feature->id);
        session()->flash('message', 'Successfully deleted feature data');
        return redirect()->route($this->routePath . '.index');
    }

    /**
     * Show the form for showing historical changes the specified resource.
     */
    public function historicalChanges(Feature $feature)
    {
        $activities = Activity::whereSubjectType(get_class($feature))
            ->whereSubjectId($feature->id)
            ->orderBy("created_at", "desc")
            ->paginate(10);
        return view('cms.' . $this->viewPath . '.historical-changes', ['model' => $feature, 'activities' => $activities]);
    }
}
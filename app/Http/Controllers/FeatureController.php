<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFeatureRequest;
use App\Http\Requests\UpdateFeatureRequest;
use App\Interfaces\FeatureRepositoryInterface;
use App\Models\Feature;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->authorizeResource(Feature::class, 'feature');
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
                        $publishHtml = '<span class="badge badge-secondary">Draft</span>';
                    }
                    return $publishHtml;
                })
                ->editColumn('sequence_number', '<center>{{$sequence_number}}</center>')
                ->addColumn('action', function ($row) {
                    $showUrl = route('cms.features.show', $row['id']);

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

        $createdFeature = $this->repository->findById($feature->id);
        $image = $createdFeature->getFirstMedia("images");
        $createdFeature->seo->update([
            'title' => $data['seo_title'],
            'description' => $data['seo_description'],
            'robots' => $data['seo_robots'],
            'canonical_url' => $data['seo_canonical_url'],
            'image' => $image != null ? $image->getUrl() : '',
            'author' => \Auth::user()->name,
        ]);

        session()->flash('message', 'Successfully saved new feature data');
        return redirect()->route('cms.' . $this->routePath . '.index');
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

        $seoTitle = Arr::pull($data, 'seo_title');
        $seoDescription = Arr::pull($data, 'seo_description');
        $seoRobots = Arr::pull($data, 'seo_robots');
        $seoCanonicalUrl = Arr::pull($data, 'seo_canonical_url');
        $this->repository->update($feature->id, $data);

        $updatedFeature = $this->repository->findById($feature->id);
        $image = $updatedFeature->getFirstMedia("images");
        $updatedFeature->seo->update([
            'title' => $seoTitle,
            'description' => $seoDescription,
            'robots' => $seoRobots,
            'canonical_url' => $seoCanonicalUrl,
            'image' => $image ? $image->getUrl() : '',
            'author' => \Auth::user()->name,
        ]);

        session()->flash('message', 'Successfully updated feature data');
        return redirect()->route('cms.' . $this->routePath . '.show', $feature);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $this->repository->delete($feature->id);
        session()->flash('message', 'Successfully deleted feature data');
        return redirect()->route('cms.' . $this->routePath . '.index');
    }

    /**
     * Show the form for showing historical changes the specified resource.
     */
    public function historicalChanges(Feature $feature)
    {
        $this->authorize('view', Auth::user());
        $activities = Activity::whereSubjectType(get_class($feature))
            ->whereSubjectId($feature->id)
            ->orderBy("created_at", "desc")
            ->paginate(10);
        return view('cms.' . $this->viewPath . '.historical-changes', ['model' => $feature, 'activities' => $activities]);
    }
}
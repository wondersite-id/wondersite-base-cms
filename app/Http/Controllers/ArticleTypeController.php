<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleTypeRequest;
use App\Http\Requests\UpdateArticleTypeRequest;
use App\Interfaces\ArticleTypeRepositoryInterface;
use App\Models\ArticleType;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class ArticleTypeController extends ResourceController
{
    private ArticleTypeRepositoryInterface $repository;

    /**
     * Construct controller
     */
    public function __construct(ArticleTypeRepositoryInterface $repo)
    {
        $this->repository = $repo;
        $this->viewPath = "article_types";
        $this->routePath = "article-types";
        view()->share([
            'title' => 'Article Types',
            'description' => 'Article type will be used for categorizing article.',
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
                ->editColumn('sequence_number', '<center>{{$sequence_number}}</center>')
                ->addColumn('related_articles', function ($row) {
                    $count = $row->articles->count();
                    if ($count == 0) {
                        return "-";
                    }
                    return $row->articles->count() . ' Associated Article' . ($count > 1 ? 's':'');
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('cms.article-types.show', $row['id']);
                    $actionBtn = '<a href="' . $showUrl . '" class="text-info"><i class="mdi mdi-eye-circle mr-1"></i>Detail</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="text-danger delete-btns" data-toggle="modal" data-target="#deleteModal" data-id="' . $row['id'] . '"><i class="mdi mdi-trash-can mr-1"></i>Delete</a></center>';
                    return $actionBtn;
                })
                ->rawColumns(['sequence_number', 'action'])
                ->make(true);
        }

        return view('cms.' . $this->viewPath . '.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleTypeRequest $request)
    {
        $data = $request->validated();
        $this->repository->create($data);

        session()->flash('message', 'Successfully saved new article type data');
        return redirect()->route('cms.' . $this->routePath . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(ArticleType $articleType)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $articleType]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArticleType $articleType)
    {
        return view('cms.' . $this->viewPath . '.edit', ['model' => $articleType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleTypeRequest $request, ArticleType $articleType)
    {
        $data = $request->validated();
        $this->repository->update($articleType->id, $data);

        session()->flash('message', 'Successfully updated ArticleType data');
        return redirect()->route('cms.' . $this->routePath . '.show', $articleType);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArticleType $articleType)
    {
        $this->repository->delete($articleType->id);
        session()->flash('message', 'Successfully deleted article type data');
        return redirect()->route('cms.' . $this->routePath . '.index');
    }

    /**
     * Show the form for showing historical changes the specified resource.
     */
    public function historicalChanges(ArticleType $articleType)
    {
        $activities = Activity::whereSubjectType(get_class($articleType))
            ->whereSubjectId($articleType->id)
            ->orderBy("created_at", "desc")
            ->paginate(10);
        return view('cms.' . $this->viewPath . '.historical-changes', ['model' => $articleType, 'activities' => $activities]);
    }
}
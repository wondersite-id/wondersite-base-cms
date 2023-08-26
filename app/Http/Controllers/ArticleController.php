<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\ArticleTypeRepositoryInterface;
use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class ArticleController extends ResourceController
{
    private ArticleRepositoryInterface $repository;
    private ArticleTypeRepositoryInterface $typeRepository;

    /**
     * Construct controller
     */
    public function __construct(ArticleRepositoryInterface $repo, ArticleTypeRepositoryInterface $typeRepo)
    {
        $this->authorizeResource(Article::class, 'article');
        $this->repository = $repo;
        $this->typeRepository = $typeRepo;
        $this->viewPath = "articles";
        $this->routePath = "articles";
        view()->share([
            'title' => ucfirst($this->routePath),
            'description' => 'Visitors will stay at your web site longer because there are lots of articles to read. This gives you additional opportunities at getting more click throughs to your affiliate programs.',
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
                ->addColumn('time_to_read', function ($row) {
                    return $row->time_to_read;
                })
                ->addColumn('type', function ($row) {
                    return $row->type->name;
                })
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
                ->addColumn('action', function ($row) {
                    $showUrl = route('cms.articles.show', $row['id']);

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
                ->rawColumns(['published', 'image', 'action'])
                ->make(true);
        }

        return view('cms.' . $this->viewPath . '.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = $this->typeRepository->getAll();
        return view('cms.' . $this->viewPath . '.create', ['types' => $types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        $uploadedImage = $data['image'];
        $data['image'] = $data['image']->getClientOriginalName();

        if (Arr::exists($data, 'published_at')) {
            $data['published_at'] = Carbon::now();
        } else {
            $data['published_at'] = null;
        }

        $article = $this->repository->create($data);
        $this->attachMediaToModel($request, $article, 'image', $uploadedImage);

        $createdModel = $this->repository->findById($article->id);
        $image = $createdModel->getFirstMedia("images");
        $createdModel->seo->update([
            'title' => $data['seo_title'],
            'description' => $data['seo_description'],
            'robots' => $data['seo_robots'],
            'canonical_url' => $data['seo_canonical_url'],
            'image' => $image != null ? $image->getUrl() : '',
            'author' => \Auth::user()->name,
        ]);

        session()->flash('message', 'Successfully saved new article data');
        return redirect()->route('cms.' . $this->routePath . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $types = $this->typeRepository->getAll();
        return view('cms.' . $this->viewPath . '.edit', ['model' => $article, 'types' => $types]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $data = $request->validated();

        if (Arr::exists($data, 'image')) {
            $uploadedImage = $data['image'];
            $this->attachMediaToModel($request, $article, 'image', $uploadedImage);
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
        $this->repository->update($article->id, $data);

        $updatedModel = $this->repository->findById($article->id);
        $image = $updatedModel->getFirstMedia("images");
        $updatedModel->seo->update([
            'title' => $seoTitle,
            'description' => $seoDescription,
            'robots' => $seoRobots,
            'canonical_url' => $seoCanonicalUrl,
            'image' => $image ? $image->getUrl() : '',
            'author' => \Auth::user()->name,
        ]);

        session()->flash('message', 'Successfully updated article data');
        return redirect()->route('cms.' . $this->routePath . '.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->repository->delete($article->id);
        session()->flash('message', 'Successfully deleted article data');
        return redirect()->route('cms.' . $this->routePath . '.index');
    }

    /**
     * Show the form for showing historical changes the specified resource.
     */
    public function historicalChanges(Article $article)
    {
        $this->authorize('view', Auth::user());
        $activities = Activity::whereSubjectType(get_class($article))
            ->whereSubjectId($article->id)
            ->orderBy("created_at", "desc")
            ->paginate(10);
        return view('cms.' . $this->viewPath . '.historical-changes', ['model' => $article, 'activities' => $activities]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Interfaces\MenuRepositoryInterface;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class MenuController extends ResourceController
{
    private MenuRepositoryInterface $repository;

    /**
     * Construct controller
     */
    public function __construct(MenuRepositoryInterface $repo)
    {
        $this->repository = $repo;
        $this->viewPath = "menus";
        $this->routePath = "menus";
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
                ->editColumn('url', '{{ (($model->url == "#" || $model->url == "javascript:void(0)")) ? "No URL Provided" : $url }}')
                ->editColumn('type', '{{ Str::ucfirst($type) }}')
                ->addColumn('new_tab', function ($row) {
                    if ($row->is_open_in_new_tab) {
                        $html = '<span class="badge badge-success">Yes</span>';
                    } else {
                        $html = '<span class="badge badge-secondary">No</span>';
                    }
                    return $html;
                })
                ->addColumn('action', function ($row) {
                    $showUrl = route('menus.show', $row['id']);
                    $actionBtn = '<a href="' . $showUrl . '" class="text-info"><i class="mdi mdi-eye-circle mr-1"></i>Detail</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="text-danger delete-btns" data-toggle="modal" data-target="#deleteModal" data-id="' . $row['id'] . '"><i class="mdi mdi-trash-can mr-1"></i>Delete</a></center>';
                    return $actionBtn;
                })
                ->rawColumns(['sequence_number', 'new_tab', 'action'])
                ->make(true);
        }

        $parentMenus = $this->repository->getAllParents();
        return view('cms.' . $this->viewPath . '.index', ['parentMenus' => $parentMenus]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentMenus = $this->repository->getAllParents();
        return view('cms.' . $this->viewPath . '.create', ['parentMenus' => $parentMenus]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $data = $request->validated();
        if (Arr::exists($data, 'is_open_in_new_tab')) {
            $data['is_open_in_new_tab'] = true;
        } else {
            $data['is_open_in_new_tab'] = false;
        }
        $this->repository->create($data);

        session()->flash('message', 'Successfully saved new feature data');
        return redirect()->route($this->routePath . '.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        $parentMenus = $this->repository->getAllParents();
        return view('cms.' . $this->viewPath . '.edit', [
            'model' => $menu,
            'parentMenus' => $parentMenus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, Menu $menu)
    {
        $data = $request->validated();
        if (Arr::exists($data, 'is_open_in_new_tab')) {
            $data['is_open_in_new_tab'] = true;
        } else {
            $data['is_open_in_new_tab'] = false;
        }
        $this->repository->update($menu->id, $data);

        session()->flash('message', 'Successfully updated menu data');
        return redirect()->route($this->routePath . '.show', $menu);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        $this->repository->delete($menu->id);
        session()->flash('message', 'Successfully deleted menu data');
        return redirect()->route($this->routePath . '.index');
    }

    /**
     * Show the form for showing historical changes the specified resource.
     */
    public function historicalChanges(Menu $menu)
    {
        $activities = Activity::whereSubjectType(get_class($menu))
            ->whereSubjectId($menu->id)
            ->orderBy("created_at", "desc")
            ->paginate(10);
        return view('cms.' . $this->viewPath . '.historical-changes', ['model' => $menu, 'activities' => $activities]);
    }
}
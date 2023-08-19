<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordUserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends ResourceController
{

    private UserRepositoryInterface $repository;

    /**
     * Construct controller
     */
    public function __construct(UserRepositoryInterface $administratorRepository)
    {
        $this->repository = $administratorRepository;
        $this->viewPath = "administrators";
        $this->routePath = "cms.administrators";
        view()->share([
            'title' => ucfirst($this->routePath),
            'description' => 'Administrators have super-admin role. They can access all of CMS module, manage order & customer data and can manage website content.',
            'routePrefix' => $this->routePath,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->getAdmins();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('cms.administrators.show', $row['id']);
                    $actionBtn = '<a href="' . $showUrl . '" class="text-info"><i class="mdi mdi-eye-circle mr-1"></i>Detail</a>&nbsp;&nbsp;' . ($row['id'] == Auth::user()->id ? '' : '<a href="javascript:void(0)" class="text-danger delete-btns" data-toggle="modal" data-target="#deleteModal" data-id="' . $row['id'] . '"><i class="mdi mdi-trash-can mr-1"></i>Delete</a>') . '</center>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('cms.' . $this->viewPath . '.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $this->repository->create($data);

        session()->flash('message', 'Successfully saved new user data');
        return redirect()->route('cms.' . $this->routePath . '.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $administrator)
    {
        return view('cms.' . $this->viewPath . '.edit', ['model' => $administrator]);
    }

    /**
     * Show the form for showing historical changes the specified resource.
     */
    public function historicalChanges(User $administrator)
    {
        $activities = Activity::whereSubjectType(get_class($administrator))
            ->whereSubjectId($administrator->id)
            ->orderBy("created_at", "desc")
            ->paginate(10);
        return view('cms.' . $this->viewPath . '.historical-changes', ['model' => $administrator, 'activities' => $activities]);
    }

    /**
     * Show the form for specified resource.
     */
    public function show(User $administrator)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $administrator]);
    }

    /**
     * Show the form for changing password user.
     */
    public function changePassword(User $administrator)
    {
        return view('cms.' . $this->viewPath . '.change-password', ['model' => $administrator]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function doChangePassword(ChangePasswordUserRequest $request, User $administrator)
    {
        $request->validated();
        $pass = ($request->only(['password']))['password'];

        $this->repository->update($administrator->id, [
            'password' => Hash::make($pass)
        ]);

        session()->flash('message', 'Successfully changed the user password');
        return redirect()->route('cms.' . $this->routePath . '.show', $administrator);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $administrator)
    {
        $data = $request->validated();
        $this->repository->update($administrator->id, $data);

        session()->flash('message', 'Successfully updated user data');
        return redirect()->route('cms.' . $this->routePath . '.show', $administrator);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $administrator)
    {
        $this->repository->delete($administrator->id);
        session()->flash('message', 'Successfully deleted user data');
        return redirect()->route('cms.' . $this->routePath . '.index');
    }
}
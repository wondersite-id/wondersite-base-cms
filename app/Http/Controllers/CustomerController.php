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

class CustomerController extends ResourceController
{

    private UserRepositoryInterface $repository;

    /**
     * Construct controller
     */
    public function __construct(UserRepositoryInterface $customerRepository)
    {
        $this->repository = $customerRepository;
        $this->viewPath = "customers";
        $this->routePath = "customers";
        view()->share([
            'title' => ucfirst($this->routePath),
            'description' => 'Customers can login to the CMS as a customer. They can manage their own orders and their website content if subscribed to the CMS add-ons',
            'routePrefix' => $this->routePath,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->repository->getCustomers();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $showUrl = route('customers.show', $row['id']);
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
        $data["is_admin"] = false;
        $this->repository->create($data);

        session()->flash('message', 'Successfully saved new user data');
        return redirect()->route($this->routePath . '.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customer)
    {
        return view('cms.' . $this->viewPath . '.edit', ['model' => $customer]);
    }

    /**
     * Show the form for specified resource.
     */
    public function show(User $customer)
    {
        return view('cms.' . $this->viewPath . '.show', ['model' => $customer]);
    }

    /**
     * Show the form for changing password user.
     */
    public function changePassword(User $customer)
    {
        return view('cms.' . $this->viewPath . '.change-password', ['model' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function doChangePassword(ChangePasswordUserRequest $request, User $customer)
    {
        $request->validated();
        $pass = ($request->only(['password']))['password'];

        $this->repository->update($customer->id, [
            'password' => Hash::make($pass)
        ]);

        session()->flash('message', 'Successfully changed the user password');
        return redirect()->route($this->routePath . '.show', $customer);
    }

    /**
     * Show the form for showing historical changes the specified resource.
     */
    public function historicalChanges(User $customer)
    {
        $activities = Activity::whereSubjectType(get_class($customer))
            ->whereSubjectId($customer->id)
            ->orderBy("created_at", "desc")
            ->paginate(10);
        return view('cms.' . $this->viewPath . '.historical-changes', ['model' => $customer, 'activities' => $activities]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $customer)
    {
        $data = $request->validated();
        $this->repository->update($customer->id, $data);

        session()->flash('message', 'Successfully updated user data');
        return redirect()->route($this->routePath . '.show', $customer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $customer)
    {
        $this->repository->delete($customer->id);
        session()->flash('message', 'Successfully deleted user data');
        return redirect()->route($this->routePath . '.index');
    }
}
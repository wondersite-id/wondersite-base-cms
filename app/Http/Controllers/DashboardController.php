<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::orderBy('created_at', 'desc')->get()->take(5);
        $data = [
            'lastActivities' => $activities,
        ];
        return view('cms.dashboard.index', ['data' => $data]);
    }
}
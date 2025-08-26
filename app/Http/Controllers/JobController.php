<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }
}
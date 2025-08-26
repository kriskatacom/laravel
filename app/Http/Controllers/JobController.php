<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use File;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->paginate(10);
        return view('admin.jobs.index', compact('jobs'));
    }

    public function show(Job $job)
    {
        return view('admin.jobs.show', compact('job'));
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.jobs.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'job_type' => 'nullable|string|max:50',
            'image' => 'nullable|image|max:2048',
        ]);

        $job = new Job();
        $job->title = $request->title;
        $job->description = $request->description;
        $job->company = $request->company;
        $job->location = $request->location;
        $job->salary = $request->salary;
        $job->job_type = $request->job_type;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/jobs'), $imageName);
            $job->image = '/images/jobs/' . $imageName;
        }

        $job->save();

        if ($request->action === 'save_and_index') {
            return redirect()->route('dashboard.jobs.index')
                ->with('success', 'Обявата е създадена успешно.');
        }

        return redirect()->route('dashboard.jobs.create')
            ->with('success', 'Обявата е създадена успешно.');
    }

    public function edit($id)
    {
        $job = Job::find($id);
        return view('admin.jobs.edit', compact('job'));
    }

    public function destroyAll()
    {
        $jobs = Job::all();

        foreach ($jobs as $job) {
            if ($job->image_url) {
                $imagePath = public_path($job->image_url);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        Job::truncate();

        return redirect()->route("dashboard.jobs.index")
            ->with("success", "Всички обяви и техните снимки бяха изтрити.");
    }
}

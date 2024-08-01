<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();
        $announcements = Announcement::byUser($user->id)->latest()->get();

        return view('announcements.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        try {
            $announcement = new Announcement();
            $announcement->user_id = Auth::id();
            $announcement->slug = Str::slug($request->title);
            $announcement->title = $request->title;
            $announcement->body = $request->body;
            $announcement->start_date = $request->start_date;
            $announcement->end_date = $request->end_date;
            $announcement->thumbnail = $request->hasFile('thumbnail') ? $request->file('thumbnail')->store('announcements', 'public') : null;
            $announcement->save();

            return to_route('announcements.index')->with('success', 'Announcement created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'An error occurred while creating announcement'.$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Announcement $announcement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('announcements.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ]);

        try {
            $announcement->slug = Str::slug($request->title ?? $announcement->title);
            $announcement->title = $request->title ?? $announcement->title;
            $announcement->body = $request->body ?? $announcement->body;
            $announcement->start_date = $request->start_date ?? $announcement->start_date;
            $announcement->end_date = $request->end_date ?? $announcement->end_date;
            $announcement->save();

            return to_route('announcements.index')->with('success', 'Announcement updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'An error occurred while updating announcement'.$th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement): RedirectResponse
    {
        try {
            $announcement->delete();

            return to_route('announcements.index')->with('success', 'Announcement deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'An error occurred while deleting announcement'.$th->getMessage());
        }
    }
}

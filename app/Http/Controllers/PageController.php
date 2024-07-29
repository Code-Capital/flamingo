<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Interest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();
        $pages = $user->pages()->paginate(10);
        return view('page.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $interests = Interest::all();
        return view('page.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image'],
            'profile_image' => ['nullable', 'image'],
            'interests' => ['required', 'array'],
            'interests.*' => ['exists:interests,id'],
        ]);

        try {
            DB::transaction(function () use ($request) {
                $page = Page::create([
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'profile_image' => $request->file('profile_image')->store('pages', 'public'),
                    'cover_image' => $request->file('cover_image')->store('pages', 'public'),
                    'description' => $request->description,
                    'is_private' => $request->is_private ? true : false,
                ]);

                $page->interests()->sync($request->interests);
            });

            return to_route('pages.index')->with('success', 'Page created successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to create page' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page): View
    {
        $interests = Interest::all();
        return view('page.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'cover_image' => ['nullable', 'image'],
            'profile_image' => ['nullable', 'image'],
            'interests' => ['required', 'array'],
            'interests.*' => ['exists:interests,id'],
        ]);

        try {
            DB::transaction(function () use ($request, $page) {
                $profileImage = $page->profile_image;
                $coverImage = $page->cover_image;

                $data = [
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'description' => $request->description,
                    'is_private' => $request->is_private ? true : false,
                ];

                if ($request->file('profile_image')) {
                    $data['profile_image'] = $request->file('profile_image')->store('pages', 'public');
                    if ($profileImage && Storage::disk('public')->exists($profileImage)) {
                        Storage::disk('public')->delete($profileImage);
                    }
                }

                if ($request->file('cover_image')) {
                    $data['cover_image'] = $request->file('cover_image')->store('pages', 'public');
                    if ($coverImage && Storage::disk('public')->exists($coverImage)) {
                        Storage::disk('public')->delete($coverImage);
                    }
                }

                $page->update($data);
                $page->interests()->sync($request->interests);
            });

            return to_route('pages.index')->with('success', 'Page updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to update page' . $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return to_route('pages.index')->with('success', 'Page deleted successfully');
    }

    public function joinedPages(): View
    {
        return view('page.joined');
    }
}

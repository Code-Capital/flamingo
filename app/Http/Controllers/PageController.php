<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\User;
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
    public function show(Page $page): View
    {
        $user = Auth::user();
        $page->load('interests', 'posts', 'posts.media', 'posts.user');
        $posts = $page->posts()->paginate(getPaginated());
        $JoinedUsers = $page->users()->paginate(getPaginated());
        return view('page.show', get_defined_vars());
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
        $user = Auth::user();
        $pages = $user->acceptedPages()->paginate(10);
        return view('page.joined', get_defined_vars());
    }

    public function pagesearch(Request $request): View
    {
        $user = Auth::user();
        // Get the search term and interests from the request
        $searchTerm = $request->input('q', '');
        $selectedInterests = $request->input('interests', []);
        $pages = [];
        if (($request->search == 'submit') && ($searchTerm || $selectedInterests)) {
            $pages = Page::bySearch($searchTerm)
                ->byInterests($selectedInterests)
                ->byNotUser(Auth::user()->id)
                ->get();
        }

        $interests = Interest::all();
        return view('page.search', get_defined_vars());
    }

    public function pagePost(Request $request, Page $page)
    {
        $user = Auth::user();
        $post = $page->posts()->create([
            'user_id' => $user->id,
            'body' => $request->body,
            'is_private' => $request->is_private ?? false,
        ]);

        // Check if media files were uploaded
        if ($request->hasFile('media')) {
            $mediaFiles = $request->file('media');
            foreach ($mediaFiles as $mediaFile) {
                $mediaPath = $mediaFile->store('/media/page/' . $post->id . '/posts/' . $user->id, 'public'); // Example storage path
                $post->media()->create([
                    'file_path' => $mediaPath,
                    'file_type' => $mediaFile->getClientOriginalExtension(), // Example file type
                ]);
            }
        }

        $post->notifications()->create([
            'type' => 'post',
            'data' => json_encode([
                'message' => 'New post created',
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]),
        ]);

        return back()->with('success', 'Post created successfully');
    }

    public function searchOwnersForPage(Request $request)
    {
        $user = Auth::user();
        $searchTerm = $request->input('q', '');
        $users = User::bySearch($searchTerm)->byNotUser($user->id)->get();
        $pageId = Page::where('id', $request->page_id)->first();
        $doneIcon = asset('assets/done.svg');
        $trashIcon = asset('assets/trash.svg');
        $html = '';
        foreach ($users as $user) {
            $html .= '
                <div class="col-lg-6 mb-3">
                    <div class="eventCardInner p-3 friendRequest">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="' . $user->avatar_url . '" class="rounded-circle">
                                <div>
                                    <span class="d-block">' . $user->full_name . '</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <a class="text-decoration-none send-invitation" data-page="' . $pageId->id . '"  data-user="' . $user->id . '" href="javascript:void(0)">
                                    <img src="' . $doneIcon . '">
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
        return $html;
    }

    public function sendJoiningInvite(Request $request)
    {
        $page = Page::where('id', $request->page_id)->first();
        $user = User::where('id', $request->user_id)->first();
        $page->users()->attach($user->id, [
            'status' => 'pending',
            'start_date' => now(),
            'is_invited' => true,
        ]);
        return $this->sendSuccessResponse('Sending invitation to ' . $user->full_name);
    }
}

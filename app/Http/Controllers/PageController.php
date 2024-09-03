<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Interest;
use App\Models\Location;
use App\Models\Page;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $loggdInUser = Auth::user();
        $user = $loggdInUser;
        $pages = $user->pages()
            ->whereDoesntHave('reports', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->paginate(getPaginated());
        $remainingPagesCount = $user->getRemainingPages();

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
        $posts = $page->posts()
            ->byPublished()
            ->byPublic()
            ->with([
                'user',
                'media',
                'likes',
                'comments' => function ($query) {
                    $query->withCount(['replies']);
                },
                'comments.user',
                'comments.replies',
            ])
            ->withCount(['comments', 'likes'])
            ->latest()
            ->paginate(getPaginated());
        $JoinedUsers = $page->acceptedUsers()->paginate(getPaginated(2));

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
        $pages = Page::bySearch($searchTerm)
            ->byInterests($selectedInterests)
            ->byLocation($request->location)
            ->byNotUser(Auth::user()->id)
            ->byPublic()
            ->whereDoesntHave('reports', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->paginate(getPaginated());

        $interests = Interest::all();
        $locations = Location::all();
        $remainingPagesCount = $user->getRemainingPages();

        return view('page.search', get_defined_vars());
    }

    public function pagePost(Request $request, Page $page)
    {
        $user = Auth::user();
        $post = $page->posts()->create([
            'uuid' => Str::uuid(),
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
            'type' => 'page',
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
        $users = User::role('user')->bySearch($searchTerm)->byNotUser($user->id)->with('joinedPages')->get();
        // dd($users->toArray());
        $page = Page::where('id', $request->page_id)->first();

        if (! $user || ! $page) {
            return $this->sendErrorResponse('Error occured while processing');
        }
        $doneIcon = asset('assets/done.svg');
        $html = '';

        foreach ($users as $user) {
            // Check if the user is already associated with the page
            $isAssociated = $user->joinedPages()->where('pages.id', $page->id)->exists();
            // Generate HTML based on association status
            $html .= '
                <div class="col-lg-4 mb-3 ">
                    <div class="eventCardInner p-3 friendRequest">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <img src="' . $user->avatar_url . '" class="rounded-circle">
                                <div>
                                    <span class="d-block">' . $user->full_name . '</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2 invite-send-' . $user->id . '">
                                ' . (! $isAssociated ? '
                                <a class="text-decoration-none send-invitation" data-page="' . $page->id . '" data-user="' . $user->id . '" href="javascript:void(0)">
                                    <img src="' . $doneIcon . '">
                                </a>
                                ' : '<span class="small text-muted"> Invite sent </span>') . '
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

        if (! $user || ! $page) {
            return $this->sendErrorResponse('Error occured while processing');
        }

        $page->users()->attach($user->id, [
            'status' => 'pending',
            'start_date' => now(),
            'is_invited' => true,
        ]);

        $pageOwner = $page->owner;

        $user->notifications()->create([
            'type' => 'invitation',
            'data' => json_encode([
                'message' => "{$pageOwner->full_name} has invited {$user->full_name} to join the page {$page->name}.",
                'user_id' => $user->id,
                'page_id' => $page->id,
                'page_owner_id' => $pageOwner->id,
            ]),
        ]);

        return $this->sendSuccessResponse('Sending invitation to ' . $user->full_name);
    }

    public function receivedJoiningInvites()
    {
        $user = Auth::user();
        $pages = $user->pendingPages()->paginate(getPaginated());

        return view('page.invites', get_defined_vars());
    }

    public function accept(Page $page)
    {
        $page->users()->updateExistingPivot(Auth::id(), ['status' => StatusEnum::ACCEPTED->value]);

        return $this->sendSuccessResponse($page, 'Invite accepted successfully');
    }

    public function reject(Page $page)
    {
        $page->users()->updateExistingPivot(Auth::id(), [
            'status' => StatusEnum::REJECTED->value,
            'end_date' => now(),
        ]);

        return $this->sendSuccessResponse($page, 'Invite rejected successfully');
    }

    public function removeMemeber(Request $request, Page $page)
    {
        try {
            $page->users()->detach($request->user_id);

            return $this->sendSuccessResponse(null, 'Memeber deleted successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while removing this memeber' . $th->getMessage());
        }
    }
}

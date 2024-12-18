<?php

namespace App\Http\Controllers;

use App\Chatify\CustomChatify;
use App\Enums\NotificationStatusEnum;
use App\Enums\StatusEnum;
use App\Jobs\PageCreationJob;
use App\Models\ChChannel;
use App\Models\Interest;
use App\Models\Location;
use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ChChannel as Channel;

class PageController extends Controller
{
    use AuthorizesRequests;

    public $customChatify;

    public function __construct()
    {
        $this->customChatify = new CustomChatify();
    }

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
            ->latest()
            ->paginate(getPaginated());
        $remainingPagesCount = $user->getRemainingPages();

        return view('page.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = Auth::user();
        // checking the user remaing pages limit
        $this->authorize('create', Page::class);
        $interests = Interest::all();

        return view('page.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:pages,name'],
            'description' => ['required', 'string', 'max:255'],
            'cover_image' => ['nullable', 'image'],
            'profile_image' => ['required', 'image'],
            'interests' => ['required', 'array'],
            'interests.*' => ['exists:interests,id'],
        ], [
            'name.unique' => 'The page name has already been taken.',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $user = Auth::user();

                $thumbnailPath = $request->profile_image ? $request->file('profile_image')->store('pages', 'public') : null;
                $coverImagePath = $request->cover_image ? $request->file('cover_image')->store('pages', 'public') : null;

                $page = Page::create([
                    'user_id' => $user->id,
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'profile_image' => $thumbnailPath,
                    'cover_image' => $coverImagePath,
                    'description' => $request->description,
                    'is_private' => $request->is_private ? true : false,
                ]);

                $page->interests()->sync($request->interests);

                dispatch(new PageCreationJob($page, $user));

                $request->merge([
                    'thumbnail' => $request->file('profile_image'),
                ]);

                $response = $this->customChatify->createGroupChat(
                    request: $request,
                    groupName: 'Page: ' . ucfirst($page->name),
                );

                // Decode JSON into an associative array
                $responseData = $response->getData(true);
                if ($responseData['status'] && $responseData['channel']) {
                    $page->update([
                        'channel_id' => $responseData['channel']['id'],
                    ]);

                    $pageChatLink = route('channel_id', $responseData['channel']['id']);

                    $notification_message = __("New group chat has been created");

                    // Create the HTML message
                    $body = limitString($page->name, 20);
                    $message = "
                        <div class='notification'>
                            " . $notification_message . " <a href='{$pageChatLink}' target='_blank'>{$body}</a>
                        </div>
                    ";

                    $user->notifications()->create([
                        'type' => NotificationStatusEnum::PAGECHATCREATED->value,
                        'data' => json_encode([
                            'message' => $message,
                            'page_id' => $page->id,
                            'channel_id' => $responseData['channel']['id'],
                            'user_id' => $user->id,
                            'user_name' => $user->user_name,
                        ]),
                    ]);
                }
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

        $isOwnerOrMember = false;
        if ($user->id === $page->user_id || $page->users()->where('user_id', $user->id)->exists()) {
            $isOwnerOrMember = true;
        }

        $JoinedUsers = $page->acceptedUsers()->paginate(getPaginated());

        $isExists = false;
        if ($page->channel_id) {
            $channel = Channel::findOrFail($page->channel_id);

            // Check if the logged-in user exists in the channel's users
            $userExists = $channel->users()->where('user_id', $user->id)->exists();

            if ($userExists) {
                $isExists = true;
            }
        }

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
        $link = route('post.edit', $post->uuid);

        $notification_message = __('New post create for page');

        // Create the HTML message
        $body = limitString($post->title, 20);
        $message = "
                    <div class='notification'>
                        " . $notification_message . " {$page->name} <a href='{$link}' target='_blank'>{$body}</a>
                    </div>
                ";

        $user->notifications()->create([
            'type' => NotificationStatusEnum::PAGEPOSTCREATED->value,
            'data' => json_encode([
                'message' => $message,
                'user_id' => $user->id,
                'post_id' => $post->id,
            ]),
        ]);

        if ($request->ajax()) {
            return $this->sendSuccessResponse($post, 'Post created successfully');
        }

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
                                    <span class="d-block">' . $user->user_name . '</span>
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
        try {
            $page = Page::where('id', $request->page_id)->first();
            $user = User::where('id', $request->user_id)->first();
            // Check if the user is allowed to send the invitation
            $this->authorize('canjoin', $page);

            if (! $user || ! $page) {
                return $this->sendErrorResponse('Error occured while processing');
            }

            DB::transaction(function () use ($page, $user) {
                $page->users()->attach($user->id, [
                    'status' => 'pending',
                    'start_date' => now(),
                    'is_invited' => true,
                ]);

                $pageOwner = $page->owner;

                $link = route('page.invite.received');

                $notification_message = __("has invited you to join the page");

                $body = limitString($page->name, 50);
                $message = "<div class='notification'>
                                <a href='{$link}' target='_blank'>
                                    {$pageOwner->full_name} {$notification_message}: {$body}.
                                </a>
                            </div>
                        ";

                $user->notifications()->create([
                    'type' => NotificationStatusEnum::PAGEINVITED->value,
                    'data' => json_encode([
                        'message' => $message,
                        'user_id' => $user->id,
                        'page_id' => $page->id,
                        'page_owner_id' => $pageOwner->id,
                    ]),
                ]);
            });

            return $this->sendSuccessResponse('Sending invitation to ' . $user->user_name);
        } catch (AuthorizationException $e) {
            $message = 'Total limit reached. You cannot further send requests';

            return $this->sendErrorResponse($message, Response::HTTP_FORBIDDEN);
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while sending invitation' . $th->getMessage());
        }
    }

    public function receivedJoiningInvites()
    {
        $user = Auth::user();
        $pages = $user->pendingPages()->paginate(getPaginated());

        return view('page.invites', get_defined_vars());
    }

    public function accept(Page $page)
    {
        try {
            DB::transaction(function () use ($page) {
                $page->users()->updateExistingPivot(Auth::id(), ['status' => StatusEnum::ACCEPTED->value]);

                if ($page->channel) {
                    $user = Auth::user();
                    // dd($page->channel->toArray(), $user->id);
                    $sync = $page->channel->users()->syncWithoutDetaching($user->id);
                    if ($sync) {
                        $message = $this->customChatify->newMessage([
                            'from_id' => $user->id,
                            'to_channel_id' => $page->channel_id,
                            'body' => $user->user_name . ' has joined the group',
                            'attachment' => null,
                        ]);
                        $message->user_name = $user->user_name;
                        $message->user_email = $user->email;

                        $messageData = $this->customChatify->parseMessage($message, null);
                        $this->customChatify->push('private-chatify.' . $page->channel_id, 'messaging', [
                            'from_id' => $user->id,
                            'to_channel_id' => $page->channel_id,
                            'message' => $this->customChatify->messageCard($messageData, true),
                        ]);
                    }
                }
            });

            return $this->sendSuccessResponse($page, 'Invite accepted successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while accepting this invite' . $th->getMessage());
        }
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
            DB::transaction(function () use ($request, $page) {
                $deattach = $page->users()->detach($request->user_id);
                $user = User::where('id', $request->user_id)->first();
                if ($deattach && $page->channel) {
                    $page->channel->users()->detach($request->user_id);

                    $message = $this->customChatify->newMessage([
                        'from_id' => $page->owner->id,
                        'to_channel_id' => $page->channel_id,
                        'body' => $user->user_name . ' removed from this group',
                        'attachment' => null,
                    ]);

                    $message->user_name = $user->user_name;
                    $message->user_email = $user->email;

                    $messageData = $this->customChatify->parseMessage($message, null);
                    $this->customChatify->push('private-chatify.' . $page->channel_id, 'messaging', [
                        'from_id' => $page->owner->id,
                        'to_channel_id' => $page->channel_id,
                        'message' => $this->customChatify->messageCard($messageData, true),
                    ]);
                }
            });

            return $this->sendSuccessResponse(null, 'Memeber deleted successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while removing this memeber' . $th->getMessage());
        }
    }

    public function leavePage(Page $page)
    {
        try {

            DB::transaction(function () use ($page) {
                $user = Auth::user();
                $deattach = $page->users()->detach($user->id);
                if ($deattach && $page->channel) {
                    $page->channel->users()->detach($user->id);

                    $message = $this->customChatify->newMessage([
                        'from_id' => $user->id,
                        'to_channel_id' => $page->channel_id,
                        'body' => $user->user_name . ' leave this group',
                        'attachment' => null,
                    ]);

                    $message->user_name = $user->user_name;
                    $message->user_email = $user->email;

                    $messageData = $this->customChatify->parseMessage($message, null);
                    $this->customChatify->push('private-chatify.' . $page->channel_id, 'messaging', [
                        'from_id' => $user->id,
                        'to_channel_id' => $page->channel_id,
                        'message' => $this->customChatify->messageCard($messageData, true),
                    ]);
                }
            });

            return $this->sendSuccessResponse($page, 'Page leaved successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while leaving this page' . $th->getMessage());
        }
    }
}

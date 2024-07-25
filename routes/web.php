<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/home', [FrontendController::class, 'home'])->name('home');
Route::get('/pricing', [FrontendController::class, 'pricing'])->name('pricing');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'sendContact'])->name('contact.send');
Route::view('verification', 'verification')->name('verification');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('verified')->name('user.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('avatar/upload', [ProfileController::class, 'upload'])->name('avatar.upload');

    Route::get('profile/info', [ProfileController::class, 'info'])->name('profile.info');
    // Route::get('/profile/force', [ProfileController::class, 'force'])->name('profile.force');

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('feed', [PostController::class, 'index'])->name('feed');
    Route::get('profile/{user:user_name}/feed', [PostController::class, 'show'])->name('user.feed.show');
    Route::post('post', [PostController::class, 'store'])->name('post.store');

    Route::post('comment/{post}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('like/{post}', [LikeController::class, 'likeOrUnlike'])->name('post.like-or-unlike');
    Route::post('reply/{comment}/store', [CommentReplyController::class, 'store'])->name('reply.store');

    Route::get('search/users', [SearchController::class, 'index'])->name('search.users');
    Route::get('add/friend/{user}', [UserController::class, 'addFriend'])->name('add-friend');

    Route::put('/friend/{user}/status', [UserController::class, 'statusUpdate'])->name('friend.request.status');
    Route::delete('/friend/{user}/remove', [UserController::class, 'removeFriend'])->name('friend.remove');

    Route::get('gallery', [UserController::class, 'gallery'])->name('gallery');
    Route::post('media/upload', [UserController::class, 'uploadMedia'])->name('media.upload');
    Route::get('messages', [ChatController::class, 'index'])->name('messages');

    // events
    Route::get('events', [EventController::class, 'index'])->name('events.index');
    Route::get('events/{event:slug}/show', [EventController::class, 'show'])->name('events.show');
    Route::get('events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('events/store', [EventController::class, 'store'])->name('events.store');
    Route::get('events/{event:slug}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('events/{event:slug}/update', [EventController::class, 'update'])->name('events.update');
    Route::delete('events/{event:slug}/delete', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('search/events', [SearchController::class, 'eventSearch'])->name('search.events');

    Route::get('joined/events', [EventController::class, 'joinedEvents'])->name('events.joined');
    Route::get('joined/events/{event:slug}/show', [EventController::class, 'show'])->name('joined.events.show');
    Route::post('/events/{event:slug}/close', [EventController::class, 'eventClose'])->name('events.close');

    // In routes/web.php or routes/api.php
    Route::post('/events/{event}/join', [EventController::class, 'joinEvent'])->name('event.join');
    Route::delete('/events/{event}/members/{user}', [EventController::class, 'removeMember'])->name('events.remove.member');
    Route::put('/events/{event}/members/{user}', [EventController::class, 'statusUpdateRequest'])->name('events.status.update');
    Route::post('/events/{event}/post/store', [EventController::class, 'eventPost'])->name('events.post.store');

    Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');
    Route::get('announcements/{announcement:slug}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
    Route::put('announcements/{announcement:slug}/update', [AnnouncementController::class, 'update'])->name('announcements.update');
    Route::delete('announcements/{announcements}/delete', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

    Route::get('my/friends', [EventController::class, 'friends'])->name('user.friends');

    Route::view('friend-feed', 'user.friend-feed')->name('friend-feed');
    Route::view('suggestions', 'user.suggestions')->name('suggestions');
    Route::view('settings', 'user.settings')->name('settings');
    Route::view('shop', 'user.shop')->name('shop');
    // Route::view('visitors', 'user.visitors')->name('visitors');

    Route::view('logs', 'test.logs')->name('logs');
    Route::view('billing', 'test.billing')->name('billing');
    Route::view('pricing', 'test.pricing')->name('pricing');

    Route::view('confirmation', 'test.confirmation')->name('confirmation');
    Route::view('marketplace', 'marketplace.index')->name('marketplace');
    Route::view('products/create', 'product.create')->name('products.create');

    //    Route::get('/notifications', function () {
    //        $user = auth()->user();
    //        return view('notifications.index', ['notifications' => $user->notifications]);
    //    })->name('notifications.index');
});

<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReplyController;
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

    Route::view('announcements', 'user.announcement')->name('announcements');

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('feed', [PostController::class, 'index'])->name('feed');
    Route::post('post', [PostController::class, 'store'])->name('post.store');

    Route::post('comment/{post}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('like/{post}', [LikeController::class, 'likeOrUnlike'])->name('post.like-or-unlike');
    Route::post('reply/{post}/store', [CommentReplyController::class, 'store'])->name('reply.store');

    Route::get('search', [SearchController::class, 'index'])->name('search');
    Route::get('add/friend/{user}', [UserController::class, 'addFriend'])->name('add-friend');
    Route::put('/friend/{user}/status', [UserController::class, 'statusUpdate'])->name('friend.request.status');
    Route::delete('/friend/{user}/remove', [UserController::class, 'removeFriend'])->name('friend.remove');

    Route::get('gallery', [UserController::class, 'gallery'])->name('gallery');
    Route::post('media/upload', [UserController::class, 'uploadMedia'])->name('media.upload');


    Route::view('friend-feed', 'user.friend-feed')->name('friend-feed');
    Route::view('messages', 'user.messages')->name('messages');
    Route::view('suggestions', 'user.suggestions')->name('suggestions');
    Route::view('settings', 'user.settings')->name('settings');
    Route::view('shop', 'user.shop')->name('shop');
    Route::view('visitors', 'user.visitors')->name('visitors');

    Route::view('logs', 'test.logs')->name('logs');
    Route::view('billing', 'test.billing')->name('billing');
    Route::view('pricing', 'test.pricing')->name('pricing');
    Route::view('confirmation', 'test.confirmation')->name('confirmation');

    Route::view('marketplace', 'marketplace.index')->name('marketplace');

    Route::view('products/create', 'product.create')->name('products.create');

    Route::view('events', 'event.index')->name('events.index');
    Route::view('events/show', 'event.show')->name('events.show');
    Route::view('events/create', 'event.create')->name('events.create');
    Route::view('events/friends', 'event.friends')->name('events.friends');

    //    Route::get('/notifications', function () {
    //        $user = auth()->user();
    //        return view('notifications.index', ['notifications' => $user->notifications]);
    //    })->name('notifications.index');
});

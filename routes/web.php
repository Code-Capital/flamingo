<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
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
    Route::view('profile/info', 'profile.info')->name('profile.info');
    // Route::get('/profile/force', [ProfileController::class, 'force'])->name('profile.force');

    Route::view('announcements', 'user.announcement')->name('announcements');

    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::get('feed', [PostController::class, 'index'])->name('feed');
    Route::post('post', [PostController::class, 'store'])->name('post.store');

    Route::get('search', [SearchController::class, 'index'])->name('search');
    Route::post('add-friend', [UserController::class, 'addFriend'])->name('add-friend');

    Route::view('friend-feed', 'user.friend-feed')->name('friend-feed');
    Route::view('gallery', 'user.gallery')->name('gallery');
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
    Route::view('events/create', 'event.create')->name('events.create');
    Route::view('events/friends', 'event.friends')->name('events.friends');


//    Route::get('/notifications', function () {
//        $user = auth()->user();
//        return view('notifications.index', ['notifications' => $user->notifications]);
//    })->name('notifications.index');
});



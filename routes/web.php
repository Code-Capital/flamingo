<?php

use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\HomePageController as AdminHomePageController;
use App\Http\Controllers\Admin\InterestController as AdminInterestController;
use App\Http\Controllers\Admin\LocationController as AdminLocationController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\Postcontroller as AdminPostcontroller;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\TermsAndConditionsController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentReplyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\vendor\Chatify\MessagesController;

require __DIR__ . '/auth.php';
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/home', [FrontendController::class, 'home'])->name('home');
Route::get('/pricing', [FrontendController::class, 'pricing'])->name('pricing');
Route::get('/terms', [FrontendController::class, 'terms'])->name('terms');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'sendContact'])->name('contact.send');
Route::view('/verification', [FrontendController::class, 'verification'])->name('verification');

Route::middleware('auth')->group(function () {
    Route::middleware(['role:user', 'blockuser'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->middleware('verified')->name('user.dashboard');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('update/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::post('avatar/upload', [ProfileController::class, 'upload'])->name('avatar.upload');
        Route::get('profile/info', [ProfileController::class, 'info'])->name('profile.info');
        Route::post('/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
        Route::get('read/notification/{id}', [NotificationController::class, 'read'])->name('notification.read');
        Route::get('read/all/notifications', [NotificationController::class, 'readAll'])->name('read.all.notification');

        Route::get('feed', [PostController::class, 'index'])->name('feed');
        Route::get('profile/{user:user_name?}/feed', [PostController::class, 'show'])->name('user.feed.show');
        Route::get('post/{post:uuid}/view', [PostController::class, 'edit'])->name('post.edit');
        Route::get('post/{post:uuid}/show', [PostController::class, 'show'])->name('post.show');
        Route::post('post/store', [PostController::class, 'store'])->name('post.store');
        Route::delete('post/{post}/delete', [PostController::class, 'destroy'])->name('post.destroy');
        Route::post('comment/{post}/store', [CommentController::class, 'store'])->name('comment.store');
        Route::post('like/{post}', [LikeController::class, 'likeOrUnlike'])->name('post.like-or-unlike');
        Route::post('reply/{comment}/store', [CommentReplyController::class, 'store'])->name('reply.store');

        Route::post('post/{post}/report', [ReportController::class, 'postReport'])->name('post.report');
        Route::post('event/{event}/report', [ReportController::class, 'eventReport'])->name('event.report');
        Route::post('page/{page}/report', [ReportController::class, 'pageReport'])->name('page.report');

        Route::get('search/users', [SearchController::class, 'index'])->name('search.users');
        Route::get('pending/friend/requests', [ProfileController::class, 'pendingRequests'])->name('pending.friend.requests');
        Route::get('add/friend/{user}', [UserController::class, 'addFriend'])->name('add-friend');
        Route::get('my/friends', [EventController::class, 'friends'])->name('user.friends');
        Route::put('/friend/{user}/status', [UserController::class, 'statusUpdate'])->name('friend.request.status');
        Route::delete('/friend/{user}/remove', [UserController::class, 'removeFriend'])->name('friend.remove');

        Route::get('gallery', [UserController::class, 'gallery'])->name('gallery');
        Route::post('media/upload', [UserController::class, 'uploadMedia'])->name('media.upload');
        Route::get('users/same-interests', [UserController::class, 'peopleWithSameInterest'])->name('people.with.same.interest');

        // eventsx  
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
        Route::post('/events/{event}/join', [EventController::class, 'joinEvent'])->name('event.join');

        Route::delete('/events/{event}/leave', [EventController::class, 'leaveEvent'])->name('event.leave');
        Route::delete('/events/{event}/members/{user}', [EventController::class, 'removeMember'])->name('events.remove.member');
        Route::put('/events/{event}/members/{user}', [EventController::class, 'statusUpdateRequest'])->name('events.status.update');
        Route::post('/events/{event}/post/store', [EventController::class, 'eventPost'])->name('events.post.store');

        // announcment
        Route::get('announcements', [AnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('announcements/create', [AnnouncementController::class, 'create'])->name('announcements.create');
        Route::post('announcements/store', [AnnouncementController::class, 'store'])->name('announcements.store');
        Route::get('announcements/{announcement:slug}/edit', [AnnouncementController::class, 'edit'])->name('announcements.edit');
        Route::put('announcements/{announcement:slug}/update', [AnnouncementController::class, 'update'])->name('announcements.update');
        Route::delete('announcements/{announcements}/delete', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

        // pages
        Route::get('pages', [PageController::class, 'index'])->name('pages.index');
        Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
        Route::post('pages/store', [PageController::class, 'store'])->name('pages.store');
        Route::get('pages/{page:slug}/show', [PageController::class, 'show'])->name('pages.show');
        Route::get('pages/{page:slug}/edit', [PageController::class, 'edit'])->name('pages.edit');
        Route::put('pages/{page:slug}/update', [PageController::class, 'update'])->name('pages.update');
        Route::delete('pages/{page:slug}/delete', [PageController::class, 'destroy'])->name('pages.destroy');
        Route::get('pages/joined', [PageController::class, 'joinedPages'])->name('pages.joined');
        Route::get('pages/joined/{page:slug}/show', [PageController::class, 'show'])->name('join.page.show');
        Route::get('search/pages', [SearchController::class, 'pagesearch'])->name('search.pages');
        Route::post('/pages/{page}/post/store', [PageController::class, 'pagePost'])->name('pages.post.store');
        Route::post('/search/user/owners', [PageController::class, 'searchOwnersForPage'])->name('search.users.page.owners');
        Route::post('/invite/send', [PageController::class, 'sendJoiningInvite'])->name('page.invite.sent');
        Route::get('invite/received', [PageController::class, 'receivedJoiningInvites'])->name('page.invite.received');
        Route::post('/accept-invite/{page}', [PageController::class, 'accept'])->name('page.invite.accept');
        Route::post('/reject-invite/{page}', [PageController::class, 'reject'])->name('page.invite.reject');
        Route::post('/remove/member/{page}', [PageController::class, 'removeMemeber'])->name('page.member.remove');
        Route::delete('/leave/page/{page}', [PageController::class, 'leavePage'])->name('page.leave');

        Route::get('join/{page:slug}/chat', [MessagesController::class, 'joinChat'])->name('chat.join');

        Route::get('checkout/{plan:uuid}/subscription', [CheckoutController::class, 'checkout'])->name('stripe.subscription.checkout');
        Route::match(['get', 'post'], 'success', [CheckoutController::class, 'success'])->name('success');
        Route::match(['get', 'post'], 'cancelled', [CheckoutController::class, 'cancel'])->name('cancel');

        Route::get('subscription', [SubscriptionController::class, 'subscriptions'])->name('stripe.subscription.mine');
        Route::get('subscription/cancel/{user?}', [SubscriptionController::class, 'cancelSubscription'])->name('stripe.subscription.cancel');
        Route::get('subscription/resume/{user?}', [SubscriptionController::class, 'resumeSubscription'])->name('stripe.subscription.resume');

        Route::get('settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('settings/update/subscrber', [AdminSettingController::class, 'updateSub'])->name('settings.update.sub');
        Route::post('settings/update/nonsubscriber', [AdminSettingController::class, 'updateUnSub'])->name('settings.update.un.sub');

        // extra routes
        Route::view('friend-feed', 'user.friend-feed')->name('friend-feed');
        Route::view('suggestions', 'user.suggestions')->name('suggestions');
        // Route::view('settings', 'user.settings')->name('settings');
        Route::view('shop', 'user.shop')->name('shop');
        Route::view('visitors', 'user.visitors')->name('visitors');
        Route::view('logs', 'test.logs')->name('logs');
        Route::view('billing', 'test.billing')->name('billing');
        Route::view('confirmation', 'test.confirmation')->name('confirmation');
        Route::view('products/create', 'product.create')->name('products.create');
        Route::view('marketplace', 'marketplace.index')->name('marketplace');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('users/list', [AdminUserController::class, 'index'])->name('users.list');
        Route::delete('users/{user}/delete', [AdminUserController::class, 'destroy'])->name('users.destroy');
        Route::put('users/{user}/block', [AdminUserController::class, 'block'])->name('admin.users.block');
        Route::put('users/{user}/unblock', [AdminUserController::class, 'unblock'])->name('admin.users.unblock');
        Route::post('/admin/users/toggle-subscription', [AdminUserController::class, 'toggleSubscription'])->name('admin.users.toggle.subscription');

        Route::resource('interests', AdminInterestController::class);
        Route::resource('locations', AdminLocationController::class);
        Route::resource('faqs', FaqController::class);

        Route::get('events/list', [AdminEventController::class, 'index'])->name('events.list');
        Route::delete('events/{event}/delete', [AdminEventController::class, 'destroy'])->name('events.destroy');

        Route::get('posts/list', [AdminPostcontroller::class, 'index'])->name('posts.list');
        Route::delete('posts/{post}/delete', [AdminPostcontroller::class, 'destroy'])->name('posts.destroy');

        Route::get('announcements/list', [AdminAnnouncementController::class, 'index'])->name('announcements.list');
        Route::delete('admin/announcements/{announcement}/delete', [AdminAnnouncementController::class, 'destroy'])->name('admin.announcements.destroy');

        Route::get('pages/list', [AdminPageController::class, 'index'])->name('pages.list');
        Route::delete('admin/pages/{page}/delete', [AdminEventController::class, 'destroy'])->name('admin.pages.destroy');

        Route::get('plans', [StripeController::class, 'index'])->name('admin.plans.index');
        Route::get('create/plans', [StripeController::class, 'create'])->name('admin.plans.create');
        Route::post('create/subscription/plan', [StripeController::class, 'store'])->name('admin.plans.store');
        Route::get('edit/subscription/plan/{plan}', [StripeController::class, 'edit'])->name('admin.plans.edit');
        Route::put('update/subscription/plan/{plan}', [StripeController::class, 'update'])->name('admin.plans.update');
        Route::delete('delete/subscription/plan/{id}', [StripeController::class, 'destroy'])->name('admin.plans.destroy');

        Route::resource('terms-conditions', TermsAndConditionsController::class);

        Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
        Route::post('/subscribers', [SubscriberController::class, 'store'])->name('subscribers.store');
        Route::delete('/subscribers/{subscriber}', [SubscriberController::class, 'destroy'])->name('subscribers.destroy');

        Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');

        Route::get('/homepage/edit', [AdminHomePageController::class, 'index'])->name('admin.homepage.edit');
        Route::put('/homepage/update/hero', [AdminHomePageController::class, 'editOrUpdateHero'])->name('admin.homepage.update.hero');
        Route::put('/homepage/update/feature', [AdminHomePageController::class, 'editOrUpdateFeature'])->name('admin.homepage.update.feature');
        Route::get('feature/create', [AdminHomePageController::class, 'featureCreate'])->name('admin.homepage.feature.create');
        Route::post('feature/store', [AdminHomePageController::class, 'featureStore'])->name('admin.homepage.feature.store');
        Route::get('feature/{feature}/edit', [AdminHomePageController::class, 'featureEdit'])->name('admin.homepage.feature.edit');
        Route::put('feature/{feature}/update', [AdminHomePageController::class, 'featureUpdate'])->name('admin.homepage.feature.update');
        Route::delete('feature/{feature}/delete', [AdminHomePageController::class, 'featureDestroy'])->name('admin.homepage.feature.destroy');
    });

    Route::post('file/upload', [FrontendController::class, 'uploadFile'])->name('files.upload');
});

Route::get('storage-link', function () {
    $response = Artisan::call('storage:link');
    return 'storage link created ' . $response;
});
Route::get('cache-clear', function () {
    Artisan::call('optimize:clear');
    return 'optimize successfully';
});

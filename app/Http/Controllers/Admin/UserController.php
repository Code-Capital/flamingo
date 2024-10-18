<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Exceptions\SubscriptionUpdateFailure;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::role('user')->where('id', '!=', User::ADMIN_ID)->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return '<a href="' . route('admin.users.show', $row->id) . '">' . $row->user_name . '</a>';
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('is_subscribed', function ($row) {
                    $checked = $row->isSubscribed() ? 'checked' : '';

                    return '
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-subscribe" type="checkbox" data-id="' . $row->id . '" ' . $checked . '>
                        </div>';
                })
                ->addColumn('action', function ($row) {
                    $button = '';
                    if ($row->isBlocked()) {
                        $button = '<button type="button" name="unblock" data-id="' . $row->id . '" class="btn btn-danger btn-sm unblock">
                            <img src="https://img.icons8.com/ios/50/000000/lock.png" width="20" height="20" alt="unlock">
                        </button> ';
                    } else {
                        $button = '<button type="button" name="block" data-id="' . $row->id . '" class="btn btn-info btn-sm block">
                            <img src="https://img.icons8.com/ios/50/000000/unlock.png" width="20" height="20" alt="lock">
                        </button>';
                    }

                    // $button = '<button type="button" name="delete" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete">Delete</button>';
                    return $button;
                })
                ->rawColumns(['name', 'is_subscribed', 'action'])
                ->make(true);
        }

        return view('admin.users.index', get_defined_vars());
    }

    public function destroy(User $user)
    {
        try {
            DB::transaction(function () use ($user) {
                $user->events()->delete();
                $user->posts()->delete();
                $user->pages()->delete();
                $user->delete();

                return $this->sendSuccessResponse(null, 'User deleted successfully');
            });
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while deleting user ' . $th->getMessage());
        }
    }

    public function block(User $user)
    {
        try {
            $user->update(['is_block' => true]);

            return $this->sendSuccessResponse(null, 'User blocked successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while blocking user ' . $th->getMessage());
        }
    }

    public function unblock(User $user)
    {
        try {
            $user->update(['is_block' => false]);

            return $this->sendSuccessResponse(null, 'User unblocked successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while unblocking user ' . $th->getMessage());
        }
    }

    public function toggleSubscription(Request $request)
    {
        $user = User::find($request->id);

        if (! $user) {
            return $this->sendErrorResponse('User not found');
        }

        try {
            if ($user->is_subscribed) {
                if ($user->subscribed('default')) {
                    $user->subscription('default')->cancel();
                }
                $user->is_subscribed = false;
                $user->save();
            } else {
                $user->is_subscribed = true;
                $user->save();
            }

            return $this->sendSuccessResponse(null, 'Subscription updated successfully');
        } catch (SubscriptionUpdateFailure $e) {
            return $this->sendErrorResponse('Error occured while updating subscription ' . $e->getMessage());
        }
    }

    public function show(User $user)
    {
        // $user = $user;
        return view('admin.users.show', get_defined_vars());
    }

    public function showUser(User $user)
    {
        // $user = $user;
        return view('user-detail', get_defined_vars());
    }
}

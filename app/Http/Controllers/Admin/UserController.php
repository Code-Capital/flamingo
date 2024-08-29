<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::role('user')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->full_name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $button = '';
                    if ($row->isBlocked()) {
                        $button = '<button type="button" name="unblock" data-id="'.$row->id.'" class="btn btn-danger btn-sm unblock">
                            <img src="https://img.icons8.com/ios/50/000000/lock.png" width="20" height="20" alt="unlock">
                        </button>';
                    } else {
                        $button = '<button type="button" name="block" data-id="'.$row->id.'" class="btn btn-info btn-sm block">
                            <img src="https://img.icons8.com/ios/50/000000/unlock.png" width="20" height="20" alt="lock">
                        </button>';
                    }

                    // $button = '<button type="button" name="delete" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete">Delete</button>';
                    return $button;
                })
                ->rawColumns(['name', 'action'])
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
            return $this->sendErrorResponse('Error occured while deleting user '.$th->getMessage());
        }
    }

    public function block(User $user)
    {
        try {
            $user->update(['is_block' => true]);

            return $this->sendSuccessResponse(null, 'User blocked successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while blocking user '.$th->getMessage());
        }
    }

    public function unblock(User $user)
    {
        try {
            $user->update(['is_block' => false]);

            return $this->sendSuccessResponse(null, 'User unblocked successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while unblocking user '.$th->getMessage());
        }
    }
}

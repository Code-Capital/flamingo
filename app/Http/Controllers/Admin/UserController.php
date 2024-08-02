<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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
                    $button = '<button type="button" name="edit" data-id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete">Delete</button>';

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
            return $this->sendErrorResponse('Error occured while deleting user ' . $th->getMessage());
        }
    }
}

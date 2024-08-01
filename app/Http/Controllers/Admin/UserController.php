<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Schema;

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
                    return ($row->created_at)->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="edit" id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('admin.users.index', get_defined_vars());
    }
}

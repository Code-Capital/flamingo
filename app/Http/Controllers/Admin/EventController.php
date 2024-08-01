<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Event::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('created_at', function ($row) {
                    return ($row->created_at)->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="edit" id="' . $row->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
                    $button .= '&nbsp;&nbsp;';
                    $button .= '<button type="button" name="delete" id="' . $row->id . '" class="delete btn
                    btn-danger btn-sm">Delete</button>';
                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('admin.events.index');
    }
}

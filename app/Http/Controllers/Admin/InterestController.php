<?php

namespace App\Http\Controllers\Admin;

use App\Models\Interest;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class InterestController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Interest::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $button = '';
                    $button = '<button type="button" name="delete" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete">Delete</button>';
                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('interests.index');
    }

    public function show(Interest $interest): View
    {
        return view('interests.show', compact('interest'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:interests,name'],
            'description' => ['nullable', 'string']
        ]);

        Interest::Create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ]);

        return to_route('interests.show')->with('success', 'Event deleted successfully');
    }
}

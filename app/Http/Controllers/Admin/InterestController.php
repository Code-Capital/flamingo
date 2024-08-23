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

                    // Encode the name and description to ensure safe embedding in HTML attributes
                    $encodedName = htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8');
                    $encodedDescription = htmlspecialchars($row->description, ENT_QUOTES, 'UTF-8');

                    $button .= '<button type="button" name="edit" data-id="' . $row->id . '" data-name="' . $encodedName . '" data-description="' . $encodedDescription . '" class="btn btn-info btn-sm edit">';
                    $button .= '<i class="fas fa-edit"></i> Edit';
                    $button .= '</button> ';

                    $button .= '<button type="button" name="delete" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete">';
                    $button .= '<i class="fas fa-trash-alt"></i> Delete';
                    $button .= '</button>';
                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }
        return view('interests.index');
    }

    public function show(Interest $interest)
    {
        return $this->sendSuccessResponse($interest, '');;
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

    public function update(Request $request, Interest $interest)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:interests,name,' . $interest->id],
            'description' => ['nullable', 'string']
        ]);

        $interest->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description
        ]);

        return to_route('interests.index')->with('success', 'Event updated successfully');
    }

    public function destroy(Interest $interest)
    {
        $interest->delete();

        return $this->sendSuccessResponse('Interest deleted successfully');
    }
}

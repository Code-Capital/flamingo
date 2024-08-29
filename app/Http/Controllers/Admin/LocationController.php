<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Location::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->addColumn('action', function ($row) {
                    $button = '';

                    // Encode the name and description to ensure safe embedding in HTML attributes
                    $encodedName = htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8');

                    $button .= '<button type="button" name="edit" data-id="'.$row->id.'" data-name="'.$encodedName.'" class="btn btn-info btn-sm edit">';
                    $button .= '<i class="fas fa-edit"></i> Edit';
                    $button .= '</button> ';

                    $button .= '<button type="button" name="delete" data-id="'.$row->id.'" class="btn btn-danger btn-sm delete">';
                    $button .= '<i class="fas fa-trash-alt"></i> Delete';
                    $button .= '</button>';

                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }

        return view('admin.locations.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:locations,name'],
        ]);

        $create = Location::updateOrCreate(['id' => $request->id], [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return $create
            ? to_route('locations.index')->with('success', 'Location created successfully.')
            : back()->with('error', 'Location could not be created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Location $location)
    {
        try {
            $location->delete();

            return $this->sendSuccessResponse(null, 'Location deleted successfully.', Response::HTTP_OK);
        } catch (\Throwable $th) {
            return $this->sendErrorResponse($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

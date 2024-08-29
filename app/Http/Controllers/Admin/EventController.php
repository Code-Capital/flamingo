<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

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
                    return $row->created_at->format('d/m/Y');
                })
                ->editColumn('location', function ($row) {
                    return $row->location->name;
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="delete" data-id="'.$row->id.'" class="delete btn
                    btn-danger btn-sm">Delete</button>';

                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }

        return view('admin.events.index');
    }

    public function destroy(Event $event)
    {
        try {
            // $event->allMembers()->delete();
            $event->delete();

            return $this->sendSuccessResponse(null, 'Event deleted successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while deleting event '.$th->getMessage());
        }
    }
}

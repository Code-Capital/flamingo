<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Announcement::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at;
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="delete" data-id="' . $row->id . '" class="delete btn
                    btn-danger btn-sm">Delete</button>';

                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }

        return view('admin.announcements.index', get_defined_vars());
    }

    public function destroy(Announcement $announcement)
    {
        try {
            $announcement->delete();
            return $this->sendSuccessResponse(null, 'Announcement deleted successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while deleting announcement ' . $th->getMessage());
        }
    }
}

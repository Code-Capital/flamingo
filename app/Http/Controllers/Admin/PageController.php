<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Page::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="delete" data-id="'.$row->id.'" class="delete btn btn-danger btn-sm">Delete</button>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.pages.index', get_defined_vars());
    }

    public function destroy(Page $page)
    {
        try {
            $page->delete();

            return $this->sendSuccessResponse(null, 'Page deleted successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while deleting Page '.$th->getMessage());
        }
    }
}

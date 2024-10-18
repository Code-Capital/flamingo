<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DogsInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Exceptions\SubscriptionUpdateFailure;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class DogsInformationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DogsInformation::latest();

            if ($request->has('filter') && $request->query('filter')) {
                $data->where('type', $request->query('filter'));
            }

            $data = $data->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    return ucwords(str_replace('_', ' ', $row->type));
                })
                ->addColumn('info', function ($row) {
                    return $row->info;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })

                ->addColumn('action', function ($row) {
                    $button = '';
                    // if ($row->isBlocked()) {
                    //     $button = '<button type="button" name="unblock" data-id="' . $row->id . '" class="btn btn-danger btn-sm unblock">
                    //         <img src="https://img.icons8.com/ios/50/000000/lock.png" width="20" height="20" alt="unlock">
                    //     </button> ';
                    // } else {
                    //     $button = '<button type="button" name="block" data-id="' . $row->id . '" class="btn btn-info btn-sm block">
                    //         <img src="https://img.icons8.com/ios/50/000000/unlock.png" width="20" height="20" alt="lock">
                    //     </button>';
                    // }

                    $button = '<button type="button" name="delete" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete-info">Delete</button>';
                    return $button;
                })
                ->rawColumns(['name', 'action'])
                ->make(true);
        }

        return view('admin.dogs-information.index', get_defined_vars());
    }


    public function store(Request $request)
    {


        $existing_record = DogsInformation::where('type', $request->type)->where('info', $request->info)->first();


        if ($existing_record != "") {
            return back()->with("error", 'Information already exists');
        }


        $data = DogsInformation::create([
            'type' => $request->type,
            'info' => $request->info,
        ]);

        return back()->with("success", 'Information added successfully');
    }


    public function destroy($id)
    {
        try {
            $record = DogsInformation::find($id);
            $record->delete();
            return $this->sendSuccessResponse(null, 'information deleted successfully');
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error occured while deleting user ' . $th->getMessage());
        }
    }


    public function show(DogsInformation $user)
    {
        // $user = $user;
        return view('admin.dogs-information.show', get_defined_vars());
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = Faq::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->full_name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $button = '';
                    $button .= '<button type="button" name="delete" data-id="' . $row->id . '" class="btn btn-danger btn-sm delete">Delete</button>';
                    return $button;
                })
                ->rawColumns(['name', 'created_at', 'action'])
                ->make(true);
        }
        return view('admin.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => ['required', 'string'],
            'answer' => ['required', 'string']
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return to_route('faqs.index')->with('success', 'Faq created successfullyu');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faq $faq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Faq $faq)
    {
        try {
            $faq->delete();
            if ($request->ajax()) {
                return $this->sendSuccessResponse(null, 'Faq Deleted Successfully', Response::HTTP_OK);
            }
        } catch (\Throwable $th) {
            return $this->sendErrorResponse('Error Occured while deleting faq!' . $th->getMessage());
        }
    }
}

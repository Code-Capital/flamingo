<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class Postcontroller extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $data = Post::with('media')->latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('user_name', function ($row) {
                    return $row?->user?->full_name;
                })
                ->addColumn('media', function ($row) {
                    $html = '';
                    if ($row->media) {
                        foreach ($row->media as $media) {
                            if (in_array($media->file_type, ['jpg', 'jpeg', 'png', 'gif', 'svg', 'webp', 'bmp'])) {
                                $html .=  $media->file_path ? '<img src="' . $media->file_path . '" width="100px" height="100px">' : '';
                            } else {
                                $html .= '<video width="100px" height="100px" controls>
                                    <source src="' . $media->file_path . '" type="video/mp4">
                                    Your browser does not support the video tag. </video>';
                            }
                        }
                    }else{
                        $html = 'No media found';
                    }
                    return $html;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d/m/Y');
                })
                ->addColumn('action', function ($row) {
                    $button = '<button type="button" name="delete" data-id="' . $row->id . '" class="delete btn
                    btn-danger btn-sm">Delete</button>';

                    return $button;
                })
                ->rawColumns(['user_name', 'media', 'action'])
                ->make(true);
        }
        return view('admin.posts.index');
    }

    public function destroy(Post $post): JsonResponse
    {
        try {
            $post->delete();

            return $this->sendSuccessResponse(null, 'Post deletd successfully');
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Error occured while deleting post ' . $th->getMessage()]);
        }
    }
}

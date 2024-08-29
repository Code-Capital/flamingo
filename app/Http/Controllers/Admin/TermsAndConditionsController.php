<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class TermsAndConditionsController extends Controller
{
    public function index()
    {
        $terms = TermsAndConditions::first();

        return view('admin.terms.index', get_defined_vars());
    }

    public function store(Request $request)
    {
        $request->validate([
            'terms' => ['required', 'string'],
        ]);

        $terms = $request->terms;
        $save = TermsAndConditions::updateOrCreate(['id' => 1], ['content' => $terms]);

        return $save
            ? to_route('terms-conditions.index')->with('success', 'Terms and Conditions updated successfully')
            : redirect()->back()->with('error', 'Something went wrong');
    }
}

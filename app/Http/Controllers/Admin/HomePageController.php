<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomePage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    public function index()
    {
        $homePage = HomePage::with('features')->first();
        return view('admin.homepage.index', get_defined_vars());
    }

    public function editOrUpdateHero(Request $request)
    {
        $data = $request->validate([
            'hero_heading' => 'required|string|max:255',
            'hero_description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $homePage = HomePage::find(1);

        if ($request->hasFile('hero_image')) {
            if ($homePage && $homePage->hero_image) {
                Storage::disk('public')->delete($homePage->hero_image);
            }
            $data['hero_image'] = $request->file('hero_image')->store('images', 'public');
        }

        HomePage::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Home page updated successfully');
    }

    public function editOrUpdateFeature(Request $request)
    {
        $data = $request->validate([
            'feature_heading' => 'required|string|max:255',
            'feature_description' => 'required|string',
        ]);

        HomePage::updateOrCreate(['id' => 1], $data);

        return back()->with('success', 'Home page updated successfully');
    }

    public function featureCreate()
    {
        return view('admin.homepage.feature-create');
    }

    public function featureStore(Request $request)
    {
        $data = $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('assets', 'public');
        }

        HomePage::find(1)->features()->create($data);

        return back()->with('success', 'Feature created successfully');
    }

    public function featureEdit(Feature $feature)
    {
        return view('admin.homepage.feature-edit', get_defined_vars());
    }

    public function featureUpdate(Request $request, Feature $feature)
    {
        $data = $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($feature->image) {
                Storage::disk('public')->delete($feature->image);
            }
            $data['image'] = $request->file('image')->store('assets', 'public');
        }

        $feature->update($data);

        return back()->with('success', 'Feature created successfully');
    }

    public function featureDelete(Feature $feature)
    {
        if ($feature->image) {
            Storage::disk('public')->delete($feature->image);
        }

        $feature->delete();

        return back()->with('success', 'Feature deleted successfully');
    }
}

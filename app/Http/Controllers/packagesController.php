<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\packagesModel;
use Illuminate\Support\Facades\Storage;
class packagesController extends Controller
{
    public function index()
    {
        $packages = packagesModel::all();
        return view('livewire.app.add-package', compact('packages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:travel_packages|max:255',
            'description' => 'required',
            'photo1' => 'required|image',
            'photo2' => 'required|image',
            'photo3' => 'required|image',
            'price' => 'required|integer',
            'default_message' => 'required'
        ]);

        packagesModel::create($request->all());

        return redirect()->back()->with('success', 'Package added successfully.');
    }

    public function delete($id)
    {
        $package = packagesModel::findOrFail($id);

        Storage::disk('public')->delete($package->photo1);
        Storage::disk('public')->delete($package->photo2);
        Storage::disk('public')->delete($package->photo3);

        $package->delete();
        return redirect()->route('packages')->with('success', 'Package deleted successfully.');
    }

    public function jsonData()
    {
        return response()->json(packagesModel::all());
    }

    public function jsonDataDetail($id)
    {
        $package = packagesModel::findOrFail($id);
        return response()->json($package);
        
    }
}

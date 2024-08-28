<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Family;
use App\Traits\UploadImage;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    use UploadImage;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = Family::paginate(num_pag());
        return view('families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255|unique:families,name",
            'description' => "required|string",
            'image' => "required|image|mimes:jpeg,png,jpg,gif|max:5000",
        ]);
        $data = $request->all();
        $data['image'] = 'uploads/families/' . $this->saveImage($request->image, 'families');
        $family = Family::create($data);
        return redirect()->route('admin.families.index')->with('success', 'تم انشاء الاسرة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $family = Family::findOrFail($id);
        return view('families.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $family = Family::find($id);
        $request->validate([

            'name' => "required|string|max:255|unique:families,name,$id",
            'description' => "required|string",
            'image' => "nullable|image|mimes:jpeg,png,jpg,gif|max:5000",
        ]);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $this->deleteImage($family->image);
            $data['image'] = 'uploads/families/' . $this->saveImage($request->image, 'families');
        } else {
            unset($data['image']);
        }

        $family->update($data);
        return redirect()->route('admin.families.index')->with('success', 'تم تعديل الاسرة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $family = Family::findOrFail($id);
        $this->deleteImage($family->image);
        $family->delete();
        return redirect()->route('admin.families.index')->with('success', 'تم حذف الاسرة بنجاح');
    }
}
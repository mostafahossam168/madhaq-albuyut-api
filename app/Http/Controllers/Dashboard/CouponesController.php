<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupones = Coupon::latest()->paginate(num_pag());
        return view('coupones.index', compact('coupones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'code' => "required|unique:coupons,code",
                'discount' => "required|numeric",
                'expire_date' => "required|date",
            ]
        );
        $data = $request->all();
        Coupon::create($data);
        return redirect()->back()->with('success', 'تم اضافة  الخصم بنجاح');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupone = Coupon::findOrFail($id);
        $request->validate(
            [
                'code' => "required|unique:coupons,code,$id",
                'discount' => "required|numeric",
                'expire_date' => "required|date",
            ]
        );
        $data = $request->all();
        $coupone->update($data);
        return redirect()->back()->with('success', 'تم تعديل  الخصم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupone = Coupon::findOrFail($id);
        $coupone->delete();
        return redirect()->back()->with('success', 'تم حذف الكوبون بنجاح');
    }
}
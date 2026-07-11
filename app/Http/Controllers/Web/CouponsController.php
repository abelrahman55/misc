<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function coupons()
    {
        $coupons = Coupon::orderBy('id', 'desc')->paginate(10);
        return view('coupons.index', compact('coupons'));
        return $coupons;
    }

    public function edit_coupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('coupons.edit', compact('coupon'));
    }

    public function create_coupon()
    {
        return view('coupons.create_coupon');
    }
    public function store_coupon(Request $request)
    {
        // return $request;
        $data = $request->validate([
            'code'             => 'required|string|unique:coupons,code',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'min_order'        => 'required|numeric|min:0',
            'usage_limit'      => 'required|integer|min:1',
            'starts_at'        => 'required|date',
            'expires_at'       => 'required|date|after:starts_at',
            'status'           => 'required|boolean',
        ]);

        Coupon::create($data);

        return redirect()->route('coupons')->with('success', 'Coupon added successfully!');
    }
    public function update_coupon(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $data = $request->validate([
            'code'             => 'required|string|unique:coupons,code,' . $coupon->id,
            'discount_percent' => 'required|numeric|min:0|max:100',
            'min_order'        => 'required|numeric|min:0',
            'usage_limit'      => 'required|integer|min:1',
            'starts_at'        => 'required|date',
            'expires_at'       => 'required|date|after:starts_at',
            'status'           => 'required|boolean',
        ]);

        $coupon->update($data);

        return redirect()->route('coupons')->with('success', 'Coupon updated successfully!');
    }
    public function delete_coupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupons')->with('success', 'Coupon deleted successfully!');
    }

    //
}

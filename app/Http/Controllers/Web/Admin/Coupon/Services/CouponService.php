<?php

namespace App\Http\Controllers\Web\Admin\Coupon\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Coupon\StoreRequest;
use App\Http\Requests\Admin\Coupon\UpdateRequest;
use App\Models\Coupon;
use Exception;
use Illuminate\Http\RedirectResponse;

class CouponService extends Controller
{
    public function storeCoupon(StoreRequest $request): RedirectResponse
    {
        try {
            $request->validated();
            Coupon::query()->create([
                'code' => $request->input('code'),
                'discount_percent' => $request->input('discount'),
            ]);
            return redirect()
                ->route('admin.coupon.index')
                ->with('success', 'Product has been successfully added');
        } catch (Exception $exception) {
            return redirect()->back()->with('Error', $exception->getMessage());
        }
    }

    public function updateCoupon(UpdateRequest $request, string $id): RedirectResponse
    {
        try {
            $request->validated();
            Coupon::query()->where('id', $id)->update([
                'code' => $request->input('code'),
                'discount_percent' => $request->input('discount'),
            ]);
            return redirect()
                ->route('admin.coupon.show', ['coupon' => $id])
                ->with('success', 'Product has been successfully updated');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function deleteCoupon(string $id): RedirectResponse
    {
        try {
            Coupon::query()->where('id', $id)->delete();
            return redirect()
                ->route('admin.coupon.index')
                ->with('success', 'Product has been successfully deleted');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

}

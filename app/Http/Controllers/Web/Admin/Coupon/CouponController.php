<?php

namespace App\Http\Controllers\Web\Admin\Coupon;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Coupon\Services\CouponService;
use App\Http\Requests\Admin\Coupon\StoreRequest;
use App\Http\Requests\Admin\Coupon\UpdateRequest;
use App\Models\Coupon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CouponController extends Controller
{

    private CouponService $service;

    public function __construct(CouponService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $coupons = Coupon::all();
        return view('Admin.Coupon.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('Admin.Coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return $this->service->storeCoupon($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $coupon = Coupon::query()->where('id', $id)->first();
        return view('Admin.Coupon.show', compact('coupon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $coupon = Coupon::query()->where('id', $id)->first();
        return view('Admin.Coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        return $this->service->updateCoupon($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        return $this->service->deleteCoupon($id);
    }
}

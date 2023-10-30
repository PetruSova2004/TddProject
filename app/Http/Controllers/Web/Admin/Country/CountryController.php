<?php

namespace App\Http\Controllers\Web\Admin\Country;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Country\Services\CountryService;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Models\Country;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CountryController extends Controller
{

    private CountryService $service;

    public function __construct(CountryService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $countries = Country::all();
        return view('Admin.Country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('Admin.Country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return $this->service->storeCountry($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $country = Country::query()->where('id', $id)->first();
        return view('Admin.Country.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $country = Country::query()->where('id', $id)->first();
        return view('Admin.Country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        try {
            $request->validated();
            $country = Country::query()->where('id', $id)->first();
            $country->update([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'zip' => $request->input('zip'),
            ]);
            return redirect()
                ->route('admin.country.show', ['country' => $country->id])
                ->with('success', 'Product has been successfully updated');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Country::query()->where('id', $id)->delete();
        return redirect()->route('admin.country.index')->with('success', 'Product has been successfully deleted');
    }
}

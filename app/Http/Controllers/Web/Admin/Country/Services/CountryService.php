<?php

namespace App\Http\Controllers\Web\Admin\Country\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Models\Country;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CountryService extends Controller
{
    public function storeCountry(StoreRequest $request): RedirectResponse
    {
        try {
            $request->validated();
            Country::query()->create([
                'name' => $request->input('name'),
                'code' => $request->input('code'),
                'zip' => $request->input('zip'),
            ]);
            return redirect()->route('admin.country.index')->with('success', 'Country has been successfully added');
        } catch (Exception $exception) {
            return redirect()->route('admin.country.index')->with('error', $exception->getMessage());
        }
    }
}

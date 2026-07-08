<?php

namespace App\Http\Controllers;

use App\Actions\Districts\BulkDeleteDistrictAction;
use App\Actions\Districts\DeleteDistrictAction;
use App\Actions\Districts\ListDistrictAction;
use App\Actions\Districts\StoreDistrictAction;
use App\Actions\Districts\UpdateDistrictAction;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;
use App\Models\District;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DistrictController extends Controller
{
    public function index(Request $request, ListDistrictAction $listDistrictAction)
    {
        $districts = $listDistrictAction->execute($request);

        return Inertia::render('Districts/Index', [
            'districts' => $districts,
        ]);
    }

    public function create()
    {
        return Inertia::render('Districts/Create');
    }

    public function store(StoreDistrictRequest $request, StoreDistrictAction $storeDistrictAction)
    {
        $storeDistrictAction->execute($request->validated());

        return redirect()->route('districts.index')
            ->with('success', 'District created successfully');
    }

    public function show(District $district)
    {
        return Inertia::render('Districts/Show', [
            'district' => $district,
        ]);
    }

    public function edit(District $district)
    {
        return Inertia::render('Districts/Edit', [
            'district' => $district,
        ]);
    }

    public function update(UpdateDistrictRequest $request, District $district, UpdateDistrictAction $updateDistrictAction)
    {
        $updateDistrictAction->execute($district, $request->validated());

        return redirect()->route('districts.index')
            ->with('success', 'District updated successfully');
    }

    public function destroy(District $district, DeleteDistrictAction $deleteDistrictAction)
    {
        $deleteDistrictAction->execute($district);

        return back()->with('success', 'District deleted successfully!');
    }

    public function bulkDestroy(Request $request, BulkDeleteDistrictAction $bulkDeleteDistrictAction)
    {
        $bulkDeleteDistrictAction->execute($request->input('ids', []));

        return back()->with('success', 'Districts deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Units;
use App\Http\Requests\UnitsRequest;
use Illuminate\Support\Facades\Storage;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $query = Units::query();

        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where('make', 'LIKE', "%{$keyword}%")
                ->orWhere('model_name', 'LIKE', "%{$keyword}%")
                ->orWhere('model_year', 'LIKE', "%{$keyword}%");
        }

        return $query->paginate(3);
    }
    public function admin_index(Request $request)
    {
        $query = Units::query();

        if ($request->filled('keyword', 'type')) {
            $keyword = $request->input('keyword');
            $query->where('make', 'LIKE', "%{$keyword}%")
                ->orWhere('model_name', 'LIKE', "%{$keyword}%")
                ->orWhere('model_year', 'LIKE', "%{$keyword}%")
                ->where('type', $request->type);
        }
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        if (!empty($minPrice) && !empty($maxPrice)) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        return $query->paginate(10);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitsRequest $request)
    {

        $validated = $request->validated();

        // Image 1
        if ($request->hasFile('image1')) {
            $validated['image1'] = $request->file('image1')->storePublicly('unitImages', 'public');
        }

        // Image 2
        if ($request->hasFile('image2')) {
            $validated['image2'] = $request->file('image2')->storePublicly('unitImages', 'public');
        }

        // Image 3
        if ($request->hasFile('image3')) {
            $validated['image3'] = $request->file('image3')->storePublicly('unitImages', 'public');
        }

        // Create unit
        $unit = Units::create($validated);

        return $unit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitsRequest $request, string $id)
    {
        $validated = $request->validated();

        $unit = Units::findOrFail($id);

        if (!is_null($unit->image1)) {
            Storage::disk('public')->delete($unit->image1);
        }

        if (!is_null($unit->image2)) {
            Storage::disk('public')->delete($unit->image2);
        }

        if (!is_null($unit->image3)) {
            Storage::disk('public')->delete($unit->image3);
        }
        $unit->update($validated);

        return $unit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {

        $unit = Units::findOrFail($id);

        if (!is_null($unit->image1)) {
            Storage::disk('public')->delete($unit->image1);
        }

        if (!is_null($unit->image2)) {
            Storage::disk('public')->delete($unit->image2);
        }

        if (!is_null($unit->image3)) {
            Storage::disk('public')->delete($unit->image3);
        }

        $unit->delete();

        return $unit;
    }
}

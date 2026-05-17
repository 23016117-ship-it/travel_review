<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LocationController extends Controller
{
    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        if ($baseSlug === '') {
            $baseSlug = 'location';
        }

        $slug = $baseSlug;
        $counter = 1;

        while (
            Location::query()
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->string('q')->toString();

        $locations = Location::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('region', 'like', "%{$search}%");
            })
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.locations.index', compact('locations', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLocationRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = $this->generateUniqueSlug($data['name']);
        $data['user_id'] = $request->user()->id;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('locations', 'public');
        }

        Location::create($data);

        return redirect()->route('admin.locations.index')->with('success', 'Location created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::findOrFail($id);

        return view('admin.locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $location = Location::findOrFail($id);

        return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLocationRequest $request, string $id)
    {
        $location = Location::findOrFail($id);
        $data = $request->validated();
        $data['slug'] = $this->generateUniqueSlug($data['name'], (int) $location->id);

        if ($request->hasFile('image')) {
            if ($location->image) {
                Storage::disk('public')->delete($location->image);
            }

            $data['image'] = $request->file('image')->store('locations', 'public');
        }

        $location->update($data);

        return redirect()->route('admin.locations.index')->with('success', 'Location updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        $location->delete();

        return redirect()->route('admin.locations.index')->with('success', 'Location deleted.');
    }
}

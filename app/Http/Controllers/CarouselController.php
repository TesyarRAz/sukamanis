<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carousel; // tambahkan model

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carousels = Carousel::all();
        return view('carousel.index', compact('carousels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carousel.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $carousel = new Carousel();

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/carousel'), $imageName);
            $carousel->image = 'uploads/carousel/' . $imageName;
        }

        $carousel->save();

        return redirect()->route('carousel.index')
            ->with('success', 'Carousel berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $carousel = Carousel::findOrFail($id);
        return view('carousel.edit', compact('carousel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $carousel = Carousel::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/carousel'), $imageName);
            $carousel->image = 'uploads/carousel/' . $imageName;
        }

        $carousel->save();

        return redirect()->route('carousel.index')
            ->with('success', 'Carousel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $carousel = Carousel::findOrFail($id);
        $carousel->delete();

        return redirect()->route('carousel.index')
            ->with('success', 'Carousel berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        return view('cars.index', [
            'cars' => auth()->user()->cars, // Logged user cars
        ]);
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'vin' => ['required', 'unique:cars,vin'],
            'model' => ['required'],
            'brand' => ['required'],
            'color' => ['required'],
        ]);

        $attributes['owner_id'] = auth()->user()->id;

        Car::create($attributes);

        return redirect('/cars')->with([
            'message' => 'Updated successfully',
        ]);
    }

    public function edit($id, Request $request)
    {
        $car = Car::find($id);

        return view('cars.edit', [
            'car' => $car,
        ]);
    }

    public function update($id, Request $request)
    {
        $car = Car::find($id);

        $attributes = $request->validate([
            'vin' => ['unique:cars,vin'],
            'model' => [],
            'brand' => [],
            'color' => [],
        ]);

        $car->update($attributes);

        return redirect('/cars')->with([
            'message' => 'Updated successfully'
        ]);
    }

    public function destroy($id)
    {
        Car::find($id)->delete();
        return redirect('/cars')->with([
            'message' => 'Deleted successfully'
        ]);
    }
}

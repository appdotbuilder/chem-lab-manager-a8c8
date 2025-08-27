<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;


class LabController extends Controller
{
    /**
     * Display a listing of the labs.
     */
    public function index(Request $request)
    {
        $query = Lab::with(['headOfLab', 'laboran', 'equipment' => function ($query) {
            $query->where('is_active', true);
        }])->where('is_active', true);

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Add equipment count
        $query->withCount('equipment');

        $labs = $query->paginate(12)->withQueryString();

        // Equipment count is already loaded via withCount

        return view('labs.index', [
            'labs' => $labs
        ]);
    }

    /**
     * Display the specified lab.
     */
    public function show(Lab $lab)
    {
        $lab->load([
            'headOfLab',
            'laboran',
            'equipment' => function ($query) {
                $query->with('category')->where('is_active', true);
            },
            'documents'
        ]);

        // Group equipment by category
        $equipmentByCategory = $lab->equipment->groupBy('category.name');

        // Equipment statistics
        $equipmentStats = [
            'total' => $lab->equipment->count(),
            'available' => $lab->equipment->where('status', 'available')->count(),
            'borrowed' => $lab->equipment->where('status', 'borrowed')->count(),
            'maintenance' => $lab->equipment->where('status', 'maintenance')->count(),
            'damaged' => $lab->equipment->where('status', 'damaged')->count(),
        ];

        return view('labs.show', [
            'lab' => $lab,
            'equipmentByCategory' => $equipmentByCategory,
            'equipmentStats' => $equipmentStats
        ]);
    }
}
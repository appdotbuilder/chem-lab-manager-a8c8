<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LabController extends Controller
{
    /**
     * Display a listing of the labs.
     */
    public function index()
    {
        $labs = Lab::with(['headOfLab', 'laboran', 'equipment' => function ($query) {
            $query->where('is_active', true);
        }])
        ->where('is_active', true)
        ->paginate(12);

        return Inertia::render('labs/index', [
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

        return Inertia::render('labs/show', [
            'lab' => $lab,
            'equipmentByCategory' => $equipmentByCategory,
            'equipmentStats' => $equipmentStats
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Lab;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the equipment.
     */
    public function index(Request $request)
    {
        $query = Equipment::with(['category', 'lab'])
            ->where('is_active', true);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('lab')) {
            $query->where('lab_id', $request->lab);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('risk_level')) {
            $query->where('risk_level', $request->risk_level);
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $equipment = $query->paginate(15)->withQueryString();

        // Get filter options
        $categories = EquipmentCategory::where('is_active', true)->get(['id', 'name']);
        $labs = Lab::where('is_active', true)->get(['id', 'name']);

        return Inertia::render('equipment/index', [
            'equipment' => $equipment,
            'categories' => $categories,
            'labs' => $labs,
            'filters' => $request->only(['search', 'category', 'lab', 'status', 'risk_level', 'sort_by', 'sort_order'])
        ]);
    }

    /**
     * Display the specified equipment.
     */
    public function show(Equipment $equipment)
    {
        $equipment->load(['category', 'lab.headOfLab', 'lab.laboran', 'incidents' => function ($query) {
            $query->with('reporter')->latest()->take(5);
        }]);

        // Check availability for next 30 days
        $availability = $this->getEquipmentAvailability($equipment, 30);

        return Inertia::render('equipment/show', [
            'equipment' => $equipment,
            'availability' => $availability
        ]);
    }

    /**
     * Get equipment availability for specified number of days.
     */
    protected function getEquipmentAvailability(Equipment $equipment, int $days)
    {
        $availability = [];
        $startDate = now()->startOfDay();

        for ($i = 0; $i < $days; $i++) {
            $date = $startDate->copy()->addDays($i);
            
            // Check if equipment is booked for this date
            $isBooked = $equipment->loanRequestItems()
                ->whereHas('loanRequest', function ($query) use ($date) {
                    $query->where('status', 'active')
                          ->where('requested_start_date', '<=', $date->endOfDay())
                          ->where('requested_end_date', '>=', $date->startOfDay());
                })
                ->exists();

            $availability[] = [
                'date' => $date->format('Y-m-d'),
                'day' => $date->format('D'),
                'available' => !$isBooked && $equipment->status === 'available',
                'status' => $isBooked ? 'booked' : $equipment->status
            ];
        }

        return $availability;
    }
}
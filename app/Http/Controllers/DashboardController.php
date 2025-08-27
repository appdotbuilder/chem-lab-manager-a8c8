<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Lab;
use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $role = $user->role->name ?? 'mahasiswa';

        $stats = $this->getDashboardStats($user, $role);
        $chartData = $this->getChartData($user, $role);
        $recentActivity = $this->getRecentActivity($user, $role);

        return view('dashboard', [
            'user' => $user->load('role'),
            'role' => $role,
            'stats' => $stats,
            'chartData' => $chartData,
            'recentActivity' => $recentActivity,
        ]);
    }

    /**
     * Get dashboard statistics based on user role.
     */
    protected function getDashboardStats($user, $role)
    {
        switch ($role) {
            case 'admin':
                return [
                    'totalUsers' => User::count(),
                    'totalLabs' => Lab::count(),
                    'totalEquipment' => Equipment::count(),
                    'totalLoanRequests' => LoanRequest::count(),
                    'pendingRegistrations' => User::where('status', 'pending')->count(),
                    'activeLoans' => LoanRequest::where('status', 'active')->count(),
                    'overdueLoans' => LoanRequest::where('status', 'overdue')->count(),
                    'availableEquipment' => Equipment::where('status', 'available')->count(),
                ];

            case 'kepala_lab':
            case 'laboran':
                $labIds = $role === 'kepala_lab' 
                    ? $user->headsLabs->pluck('id')
                    : $user->assistsLabs->pluck('id');

                return [
                    'myLabs' => $labIds->count(),
                    'labEquipment' => Equipment::whereIn('lab_id', $labIds)->count(),
                    'pendingApprovals' => LoanRequest::whereHas('items.equipment', function ($q) use ($labIds) {
                        $q->whereIn('lab_id', $labIds);
                    })->whereIn('status', ['awaiting_laboran_approval'])->count(),
                    'activeLoans' => LoanRequest::whereHas('items.equipment', function ($q) use ($labIds) {
                        $q->whereIn('lab_id', $labIds);
                    })->where('status', 'active')->count(),
                    'overdueLoans' => LoanRequest::whereHas('items.equipment', function ($q) use ($labIds) {
                        $q->whereIn('lab_id', $labIds);
                    })->where('status', 'overdue')->count(),
                    'maintenanceEquipment' => Equipment::whereIn('lab_id', $labIds)->where('status', 'maintenance')->count(),
                ];

            case 'dosen':
                return [
                    'pendingSupervisions' => LoanRequest::where('supervisor_id', $user->id)
                        ->where('status', 'awaiting_lecturer_approval')->count(),
                    'activelySupervisedLoans' => LoanRequest::where('supervisor_id', $user->id)
                        ->where('status', 'active')->count(),
                    'totalSupervisions' => LoanRequest::where('supervisor_id', $user->id)->count(),
                    'studentsSupervised' => LoanRequest::where('supervisor_id', $user->id)
                        ->distinct('borrower_id')->count(),
                ];

            case 'mahasiswa':
            default:
                return [
                    'myLoanRequests' => LoanRequest::where('borrower_id', $user->id)->count(),
                    'activeLoanRequests' => LoanRequest::where('borrower_id', $user->id)->where('status', 'active')->count(),
                    'pendingLoanRequests' => LoanRequest::where('borrower_id', $user->id)->pending()->count(),
                    'completedLoanRequests' => LoanRequest::where('borrower_id', $user->id)->where('status', 'returned')->count(),
                    'availableEquipment' => Equipment::where('status', 'available')->count(),
                    'availableLabs' => Lab::where('is_active', true)->count(),
                ];
        }
    }

    /**
     * Get chart data for dashboard.
     */
    protected function getChartData($user, $role)
    {
        // Equipment utilization by category
        $equipmentByCategory = Equipment::join('equipment_categories', 'equipment.category_id', '=', 'equipment_categories.id')
            ->selectRaw('equipment_categories.name as category, COUNT(*) as count')
            ->groupBy('equipment_categories.name')
            ->get()
            ->pluck('count', 'category');

        // Monthly loan requests for the last 6 months
        $monthlyLoans = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = LoanRequest::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            $monthlyLoans[$date->format('M Y')] = $count;
        }

        return [
            'equipmentByCategory' => $equipmentByCategory,
            'monthlyLoans' => $monthlyLoans,
        ];
    }

    /**
     * Get recent activity based on user role.
     */
    protected function getRecentActivity($user, $role)
    {
        switch ($role) {
            case 'admin':
                return [
                    'recentRegistrations' => User::where('status', 'pending')
                        ->with('role')
                        ->latest()
                        ->take(5)
                        ->get(),
                    'recentLoanRequests' => LoanRequest::with(['borrower', 'items.equipment'])
                        ->latest()
                        ->take(5)
                        ->get(),
                ];

            case 'kepala_lab':
            case 'laboran':
                $labIds = $role === 'kepala_lab' 
                    ? $user->headsLabs->pluck('id')
                    : $user->assistsLabs->pluck('id');

                return [
                    'pendingApprovals' => LoanRequest::whereHas('items.equipment', function ($q) use ($labIds) {
                        $q->whereIn('lab_id', $labIds);
                    })->with(['borrower', 'items.equipment'])
                    ->whereIn('status', ['awaiting_laboran_approval'])
                    ->latest()
                    ->take(5)
                    ->get(),
                ];

            case 'dosen':
                return [
                    'pendingSupervisions' => LoanRequest::where('supervisor_id', $user->id)
                        ->where('status', 'awaiting_lecturer_approval')
                        ->with(['borrower', 'items.equipment'])
                        ->latest()
                        ->take(5)
                        ->get(),
                ];

            case 'mahasiswa':
            default:
                return [
                    'myRecentRequests' => LoanRequest::where('borrower_id', $user->id)
                        ->with(['items.equipment.lab'])
                        ->latest()
                        ->take(5)
                        ->get(),
                ];
        }
    }
}
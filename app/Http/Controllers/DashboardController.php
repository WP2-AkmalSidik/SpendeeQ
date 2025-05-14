<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Category;
use App\Models\DailySummary;
use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today()->format('Y-m-d');
        $yesterday = Carbon::yesterday()->format('Y-m-d');
        
        // Get today's expenses
        $todayExpenses = $this->getDailyExpenses($user->id, $today);
        $todayTotal = $todayExpenses->sum('amount');
        
        // Get yesterday's expenses for comparison
        $yesterdayExpenses = $this->getDailyExpenses($user->id, $yesterday);
        $yesterdayTotal = $yesterdayExpenses->sum('amount');
        
        // Calculate percentage change
        $percentageChange = $yesterdayTotal > 0 
            ? round((($todayTotal - $yesterdayTotal) / $yesterdayTotal) * 100) 
            : 0;
        
        // Get top categories (for the current month)
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth = Carbon::now()->endOfMonth()->format('Y-m-d');
        $topCategories = $this->getTopCategories($user->id, $startOfMonth, $endOfMonth);
        
        // Recent transactions
        $recentTransactions = $this->getRecentTransactions($user->id, 3);
        
        // Weekly comparison data
        $weeklyComparison = $this->getWeeklyComparison($user->id);
        
        // Monthly comparison data
        $monthlyComparison = $this->getMonthlyComparison($user->id);
        
        // Yearly comparison data
        $yearlyComparison = $this->getYearlyComparison($user->id);
        
        // Chart data
        $chartData = [
            'week' => $this->getWeeklyChartData($user->id),
            'month' => $this->getMonthlyChartData($user->id),
            'year' => $this->getYearlyChartData($user->id)
        ];
        
        return view('home', compact(
            'todayTotal',
            'yesterdayTotal',
            'percentageChange',
            'topCategories',
            'recentTransactions',
            'weeklyComparison',
            'monthlyComparison',
            'yearlyComparison',
            'chartData'
        ));
    }
    
    private function getDailyExpenses($userId, $date)
    {
        return Expense::where('user_id', $userId)
            ->whereDate('date', $date)
            ->with('category')
            ->get();
    }
    
    private function getTopCategories($userId, $startDate, $endDate, $limit = 3)
    {
        return DB::table('expenses')
            ->join('categories', 'expenses.category_id', '=', 'categories.id')
            ->select(
                'categories.id',
                'categories.name',
                'categories.icon',
                'categories.color',
                DB::raw('COUNT(expenses.id) as transaction_count'),
                DB::raw('SUM(expenses.amount) as total_amount')
            )
            ->where('expenses.user_id', $userId)
            ->whereBetween('expenses.date', [$startDate, $endDate])
            ->groupBy('categories.id', 'categories.name', 'categories.icon', 'categories.color')
            ->orderByDesc('total_amount')
            ->limit($limit)
            ->get()
            ->map(function($category) use ($startDate, $endDate, $userId) {
                // Calculate percentage of total
                $totalSpent = DB::table('expenses')
                    ->where('user_id', $userId)
                    ->whereBetween('date', [$startDate, $endDate])
                    ->sum('amount');
                
                $percentage = $totalSpent > 0 
                    ? round(($category->total_amount / $totalSpent) * 100) 
                    : 0;
                
                return (object) array_merge((array) $category, ['percentage' => $percentage]);
            });
    }
    
    private function getRecentTransactions($userId, $limit = 3)
    {
        return Expense::where('user_id', $userId)
            ->with('category')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->limit($limit)
            ->get();
    }
    
    private function getWeeklyComparison($userId)
    {
        $now = Carbon::now();
        
        // Current week (last 7 days)
        $currentWeekStart = $now->copy()->subDays(6)->startOfDay();
        $currentWeekEnd = $now->copy()->endOfDay();
        
        // Previous week (7 days before current week)
        $previousWeekStart = $now->copy()->subDays(13)->startOfDay();
        $previousWeekEnd = $now->copy()->subDays(7)->endOfDay();
        
        $currentWeekTotal = Expense::where('user_id', $userId)
            ->whereBetween('date', [$currentWeekStart->format('Y-m-d'), $currentWeekEnd->format('Y-m-d')])
            ->sum('amount');
            
        $previousWeekTotal = Expense::where('user_id', $userId)
            ->whereBetween('date', [$previousWeekStart->format('Y-m-d'), $previousWeekEnd->format('Y-m-d')])
            ->sum('amount');
            
        $percentageChange = $previousWeekTotal > 0 
            ? round((($currentWeekTotal - $previousWeekTotal) / $previousWeekTotal) * 100) 
            : 0;
            
        return [
            'current' => [
                'total' => $currentWeekTotal,
                'start_date' => $currentWeekStart->format('Y-m-d'),
                'end_date' => $currentWeekEnd->format('Y-m-d'),
                'label' => $currentWeekStart->format('j') . '-' . $currentWeekEnd->format('j M Y')
            ],
            'previous' => [
                'total' => $previousWeekTotal,
                'start_date' => $previousWeekStart->format('Y-m-d'),
                'end_date' => $previousWeekEnd->format('Y-m-d'),
                'label' => $previousWeekStart->format('j') . '-' . $previousWeekEnd->format('j M Y')
            ],
            'percentage_change' => $percentageChange
        ];
    }
    
    private function getMonthlyComparison($userId)
    {
        $now = Carbon::now();
        
        // Current month
        $currentMonthStart = $now->copy()->startOfMonth();
        $currentMonthEnd = $now->copy();
        
        // Previous month
        $previousMonthStart = $now->copy()->subMonth()->startOfMonth();
        $previousMonthEnd = $now->copy()->subMonth()->endOfMonth();
        
        $currentMonthTotal = Expense::where('user_id', $userId)
            ->whereBetween('date', [$currentMonthStart->format('Y-m-d'), $currentMonthEnd->format('Y-m-d')])
            ->sum('amount');
            
        $previousMonthTotal = Expense::where('user_id', $userId)
            ->whereBetween('date', [$previousMonthStart->format('Y-m-d'), $previousMonthEnd->format('Y-m-d')])
            ->sum('amount');
            
        $percentageChange = $previousMonthTotal > 0 
            ? round((($currentMonthTotal - $previousMonthTotal) / $previousMonthTotal) * 100) 
            : 0;
            
        return [
            'current' => [
                'total' => $currentMonthTotal,
                'start_date' => $currentMonthStart->format('Y-m-d'),
                'end_date' => $currentMonthEnd->format('Y-m-d'),
                'label' => '1-' . $currentMonthEnd->format('j') . ' ' . $currentMonthEnd->format('M Y')
            ],
            'previous' => [
                'total' => $previousMonthTotal,
                'start_date' => $previousMonthStart->format('Y-m-d'),
                'end_date' => $previousMonthEnd->format('Y-m-d'),
                'label' => '1-' . $previousMonthEnd->format('j') . ' ' . $previousMonthEnd->format('M Y')
            ],
            'percentage_change' => $percentageChange
        ];
    }
    
    private function getYearlyComparison($userId)
    {
        $now = Carbon::now();
        
        // Current year to date
        $currentYearStart = $now->copy()->startOfYear();
        $currentYearEnd = $now->copy();
        
        // Same period last year
        $previousYearStart = $now->copy()->subYear()->startOfYear();
        $previousYearEnd = $now->copy()->subYear()->setMonth($now->month)->setDay($now->day);
        
        $currentYearTotal = Expense::where('user_id', $userId)
            ->whereBetween('date', [$currentYearStart->format('Y-m-d'), $currentYearEnd->format('Y-m-d')])
            ->sum('amount');
            
        $previousYearTotal = Expense::where('user_id', $userId)
            ->whereBetween('date', [$previousYearStart->format('Y-m-d'), $previousYearEnd->format('Y-m-d')])
            ->sum('amount');
            
        $percentageChange = $previousYearTotal > 0 
            ? round((($currentYearTotal - $previousYearTotal) / $previousYearTotal) * 100) 
            : 0;
            
        return [
            'current' => [
                'total' => $currentYearTotal,
                'start_date' => $currentYearStart->format('Y-m-d'),
                'end_date' => $currentYearEnd->format('Y-m-d'),
                'label' => $currentYearStart->format('M') . '-' . $currentYearEnd->format('M Y')
            ],
            'previous' => [
                'total' => $previousYearTotal,
                'start_date' => $previousYearStart->format('Y-m-d'),
                'end_date' => $previousYearEnd->format('Y-m-d'),
                'label' => $previousYearStart->format('M') . '-' . $previousYearEnd->format('M Y')
            ],
            'percentage_change' => $percentageChange
        ];
    }
    
    private function getWeeklyChartData($userId)
    {
        $now = Carbon::now();
        $startDate = $now->copy()->startOfWeek(CarbonInterface::MONDAY);
        $endDate = $now->copy()->endOfWeek(CarbonInterface::SUNDAY);
        
        $labels = [];
        $data = [];
        
        $day = $startDate->copy();
        
        while ($day->lte($endDate)) {
            $labels[] = $day->locale('id')->shortDayName;
            
            $dayTotal = Expense::where('user_id', $userId)
                ->whereDate('date', $day->format('Y-m-d'))
                ->sum('amount');
                
            $data[] = $dayTotal;
            
            $day->addDay();
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    
    private function getMonthlyChartData($userId)
    {
        $now = Carbon::now();
        $startDate = $now->copy()->startOfMonth();
        $endDate = $now->copy()->endOfMonth();
        
        $weeks = ceil($endDate->format('j') / 7);
        
        $labels = [];
        $data = [];
        
        for ($i = 0; $i < $weeks; $i++) {
            $weekStart = $startDate->copy()->addDays($i * 7);
            $weekEnd = $weekStart->copy()->addDays(6);
            
            if ($weekEnd->gt($endDate)) {
                $weekEnd = $endDate->copy();
            }
            
            $labels[] = 'Minggu ' . ($i + 1);
            
            $weekTotal = Expense::where('user_id', $userId)
                ->whereBetween('date', [
                    $weekStart->format('Y-m-d'),
                    $weekEnd->format('Y-m-d')
                ])
                ->sum('amount');
                
            $data[] = $weekTotal;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
    
    private function getYearlyChartData($userId)
    {
        $now = Carbon::now();
        $startDate = $now->copy()->startOfYear();
        
        $labels = [];
        $data = [];
        
        for ($i = 0; $i < 12; $i++) {
            $monthStart = Carbon::create($now->year, $i + 1, 1);
            $monthEnd = $monthStart->copy()->endOfMonth();
            
            $labels[] = $monthStart->locale('id')->shortMonthName;
            
            // If month is in the future, set to 0
            if ($monthStart->gt($now)) {
                $data[] = 0;
                continue;
            }
            
            $monthTotal = Expense::where('user_id', $userId)
                ->whereBetween('date', [
                    $monthStart->format('Y-m-d'),
                    $monthEnd->format('Y-m-d')
                ])
                ->sum('amount');
                
            $data[] = $monthTotal;
        }
        
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }
}
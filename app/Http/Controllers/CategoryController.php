<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display the category listing page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $userId = Auth::id();
        $categories = Category::forUser($userId)
            ->withCount([
                'expenses' => function ($query) use ($userId) {
                    $query->where('user_id', $userId);
                }
            ])
            ->with([
                'expenses' => function ($query) use ($userId) {
                    $query->select('category_id', DB::raw('SUM(amount) as total_amount'))
                        ->where('user_id', $userId)
                        ->groupBy('category_id');
                }
            ])
            ->orderBy('name')
            ->get();

        // Find the category with most expenses for the current user
        $topCategory = null;
        $topCategoryPercentage = 0;

        $totalExpensesCount = Expense::where('user_id', Auth::id())->count();

        if ($totalExpensesCount > 0) {
            $categoryExpenseCounts = Expense::where('user_id', Auth::id())
                ->select('category_id', DB::raw('count(*) as count'))
                ->groupBy('category_id')
                ->orderBy('count', 'desc')
                ->first();

            if ($categoryExpenseCounts) {
                $topCategory = Category::find($categoryExpenseCounts->category_id);
                $topCategoryPercentage = round(($categoryExpenseCounts->count / $totalExpensesCount) * 100);
            }
        }

        return view('category', [
            'categories' => $categories,
            'totalCategories' => $categories->count(),
            'topCategory' => $topCategory,
            'topCategoryPercentage' => $topCategoryPercentage,
        ]);
    }

    /**
     * Store a newly created category in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
            'color' => 'required|string|max:50',
        ]);

        $category = Category::create([
            'user_id' => Auth::id(), // Assign to current user
            'name' => $request->name,
            'icon' => $request->icon,
            'color' => $request->color,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil ditambahkan',
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        $category = Category::where(function ($query) {
            $query->whereNull('user_id') // Global categories can be viewed
                ->orWhere('user_id', Auth::id()); // Or user's own categories
        })->findOrFail($id);

        return response()->json([
            'category' => $category
        ]);
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'required|string|max:50',
            'color' => 'required|string|max:50',
        ]);

        // Only allow editing user's own categories, not global ones
        $category = Category::where('user_id', Auth::id())->findOrFail($id);

        $category->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'color' => $request->color,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil diperbarui',
            'category' => $category
        ]);
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // Only allow deleting user's own categories, not global ones
        $category = Category::where('user_id', Auth::id())->findOrFail($id);

        // If there are expenses linked to this category, you might want to handle them
        // For example, reassign them to a default category or delete them

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}

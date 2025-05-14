<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the expenses.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $expenses = Expense::where('user_id', Auth::id())
            ->with('category')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(15);

        $categories = Category::forUser(Auth::id())->orderBy('name')->get();

        return view('add-expense', [
            'expenses' => $expenses,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created expense in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'time' => 'nullable|date_format:H:i',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        // Verify this category is accessible to this user
        $category = Category::forUser(Auth::id())->findOrFail($request->category_id);

        Expense::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'date' => $request->date,
            'time' => $request->time,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        $this->updateDailySummary(Auth::id(), $request->date);

        return redirect()->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified expense.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $expense = Expense::where('user_id', Auth::id())->findOrFail($id);
        $categories = Category::forUser(Auth::id())->orderBy('name')->get();

        return view('expenses.edit', [
            'expense' => $expense,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified expense in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'date' => 'required|date',
            'time' => 'nullable|date_format:H:i',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $expense = Expense::where('user_id', Auth::id())->findOrFail($id);

        // Verify this category is accessible to this user
        $category = Category::forUser(Auth::id())->findOrFail($request->category_id);

        $expense->update([
            'category_id' => $request->category_id,
            'date' => $request->date,
            'time' => $request->time,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);
        // Hitung ulang daily summary lama jika tanggal diubah
        if ($expense->date !== $request->date) {
            $this->updateDailySummary(Auth::id(), $expense->date); // tanggal lama
        }

        $this->updateDailySummary(Auth::id(), $request->date); // tanggal baru

        return redirect()->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil diperbarui');
    }

    /**
     * Remove the specified expense from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $expense = Expense::where('user_id', Auth::id())->findOrFail($id);
        $expense->delete();
        
        $this->updateDailySummary(Auth::id(), $expense->date);

        return redirect()->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil dihapus');
    }

    private function updateDailySummary($userId, $date)
    {
        $total = Expense::where('user_id', $userId)
            ->whereDate('date', $date)
            ->sum('amount');

        \App\Models\DailySummary::updateOrCreate(
            ['user_id' => $userId, 'date' => $date],
            ['total_amount' => $total]
        );
    }

}
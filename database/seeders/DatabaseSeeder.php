<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Expense;
use App\Models\DailySummary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat user utama
        $user = User::factory()->create([
            'name' => 'akml',
            'email' => 'akml@spendeeq.com',
            'password' => Hash::make('password12'),
        ]);

        // 2. Buat beberapa kategori global
        $globalCategories = [
            ['name' => 'Transportasi', 'icon' => 'car', 'color' => 'blue'],
            ['name' => 'Makanan', 'icon' => 'utensils', 'color' => 'red'],
            ['name' => 'Kesehatan', 'icon' => 'heartbeat', 'color' => 'green'],
        ];

        foreach ($globalCategories as $cat) {
            Category::create(array_merge($cat, ['user_id' => null]));
        }

        // 3. Buat kategori milik user
        $userCategories = [
            ['name' => 'Ngopi', 'icon' => 'coffee', 'color' => 'yellow'],
            ['name' => 'Belanja Online', 'icon' => 'shopping-cart', 'color' => 'purple'],
        ];

        foreach ($userCategories as $cat) {
            Category::create(array_merge($cat, ['user_id' => $user->id]));
        }

        // Ambil semua kategori milik user (untuk digunakan dalam pengeluaran)
        $categories = Category::whereNull('user_id')
            ->orWhere('user_id', $user->id)
            ->get();

        // 4. Buat beberapa pengeluaran acak selama seminggu terakhir
        $expenses = [];
        $dateNow = Carbon::now();

        for ($i = 0; $i < 20; $i++) {
            $date = $dateNow->copy()->subDays(rand(0, 6));
            $amount = rand(1000, 100000);

            $expenses[] = Expense::create([
                'user_id'    => $user->id,
                'category_id'=> $categories->random()->id,
                'date'       => $date->toDateString(),
                'time'       => $date->toTimeString(),
                'amount'     => $amount,
                'description'=> fake()->sentence(),
            ]);
        }

        // 5. Buat daily summary berdasarkan pengeluaran yang dibuat
        $grouped = collect($expenses)->groupBy(function ($expense) {
            return $expense->date;
        });

        foreach ($grouped as $date => $dayExpenses) {
            $total = $dayExpenses->sum('amount');

            DailySummary::create([
                'user_id'      => $user->id,
                'date'         => $date,
                'total_amount' => $total,
            ]);
        }

        $this->command->info('Database seeded successfully with user, categories, expenses, and summaries!');
    }
}

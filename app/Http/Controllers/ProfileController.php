<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Get total expenses for current month
        $totalExpensesThisMonth = $user->expenses()
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('amount');
            
        // Get count of expenses for current month
        $expenseCountThisMonth = $user->expenses()
            ->whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->count();
            
        return view('profile', compact('user', 'totalExpensesThisMonth', 'expenseCountThisMonth'));
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'profile_photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);
        
        $user = Auth::user();
        
        // Update name
        $user->name = $request->name;
        
        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            
            // Store new photo
            $photoPath = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $photoPath;
        }
        
        $user->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Profil berhasil disimpan',
            'user' => [
                'name' => $user->name,
                'profile_photo' => $user->profile_photo ? Storage::url($user->profile_photo) : null,
            ]
        ]);
    }
    
    public function updatePassword(Request $request)
    {
        $request->validate([
            'new_password' => ['required', 'string', Password::min(8), 'confirmed'],
        ]);
        
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Password berhasil diubah',
        ]);
    }
}
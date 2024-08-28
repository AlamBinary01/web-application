<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function storeUserData(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'phone_number' => 'required|string',
            'last_visit_date' => 'required|date'
        ]);

        // Check if the user already exists
        $user = User::where('phone_number', $validated['phone_number'])->first();

        if ($user) {
            // Update existing user
            $user->visit_count += 1; // Increment visit count
            $user->last_visit_date = $validated['last_visit_date']; // Update last visit date
            $user->save(); // Save changes
        } else {
            // Create a new user
            User::create([
                'phone_number' => $validated['phone_number'],
                'visit_count' => 1, // Initialize visit count
                'last_visit_date' => $validated['last_visit_date']
            ]);
        }

        return response()->json(['message' => 'User data stored successfully']);
    }

    public function showUserData($phone_number)
    {
        // Find the user by phone number
        $user = User::where('phone_number', $phone_number)->first();

        if (!$user) {
            // If no user is found, redirect back or show an error message
            return redirect()->back()->with('error', 'User not found.');
        }

        // Pass the user data to the view
        return view('user.show', compact('user'));
    }


    public function showAllUsers()
    {
        $users = User::all(); // Fetch all users from the database

        // Map user data to FullCalendar events
        $userEvents = $users->map(function($user) {
            return [
                'title' => 'Visit',
                'start' => $user->last_visit_date,
                'color' => 'red'
            ];
        });

        // Pass users and userEvents to the view
        return view('admin.users', [
            'users' => $users,
            'userEvents' => $userEvents
        ]);
    }
}

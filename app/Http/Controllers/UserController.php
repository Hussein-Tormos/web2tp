<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function create()
    {
        return view('signup');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:3|confirmed',
        ]);

        try {
            User::create([
                'first_name' => $validatedData['first_name'],
                'last_name' => $validatedData['last_name'],
                'gender' => $validatedData['gender'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            return redirect()->route('signin.form');
        } catch (\Exception $e) {
            Log::error('User registration failed: ' . $e->getMessage());
            return redirect()->route('signup.form')
                ->withInput()
                ->with('error', 'An error occurred during registration. Please try again.');
        }
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::query();

        $searchName = $request->input('search_name');
        $searchEmail = $request->input('search_email');

        if ($searchName) {
            $query->where(function ($q) use ($searchName) {
                $q->where('first_name', 'LIKE', "%{$searchName}%")
                    ->orWhere('last_name', 'LIKE', "%{$searchName}%");
            });
        }

        if ($searchEmail) {
            $query->where('email', 'LIKE', "%{$searchEmail}%");
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('users.index', [
            'users' => $users,
            'search_name' => $searchName,
            'search_email' => $searchEmail
        ]);
    }

    /**
     * 
     *
     * @param  \App\Models\User  $user 
     * @return \Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    /**
     * 
     *
     * @param  \App\Models\User  $user 
     * @return \Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('users.edit', ['user' => $user]);
    }

    /**
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'gender' => ['required', 'string', Rule::in(['male', 'female'])]
        ]);

        try {
            $user->update($validatedData); // Update the user using mass assignment

            return redirect()->route('users.index')
                ->with('success', 'User "' . $user->first_name . ' ' . $user->last_name . '" updated successfully.');
        } catch (\Exception $e) {
            Log::error('User update failed for user ID ' . $user->id . ': ' . $e->getMessage());
            return redirect()->route('users.edit', $user)
                ->withInput()
                ->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }

    /**
     * 
     *
     * @param  \App\Models\User  $user 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        try {
            $userName = $user->first_name . ' ' . $user->last_name;
            $user->delete();

            return redirect()->route('users.index')
                ->with('success', 'User "' . $userName . '" deleted successfully.');
        } catch (\Exception $e) {
            Log::error('User deletion failed for user ID ' . $user->id . ': ' . $e->getMessage());
            return redirect()->route('users.index')
                ->with('error', 'An error occurred while deleting the user.');
        }
    }
}

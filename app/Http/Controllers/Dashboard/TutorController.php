<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tutor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TutorController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.tutors.index', [
            'tutors' => Tutor::with('user')->paginate(10),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.tutors.create');
    }

    /**
     * @param Tutor $tutor
     * @return View
     */
    public function edit(Tutor $tutor): View
    {
        return view('dashboard.tutors.edit', [
            'tutor' => $tutor,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'date_of_birth' => 'required|date|before:'.Carbon::now()->subYears(18)->format('Y-m-d'),
        ]);

        try {
            DB::transaction(function () use ($validatedData) {
                $user = User::query()->create([
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'middle_name' => $validatedData['middle_name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt(time()),
                    'date_of_birth' => $validatedData['date_of_birth'],
                ]);

                Tutor::query()->create([
                    'user_id' => $user->id,
                ]);
            });
            return redirect()->route('dashboard.tutors.index')->with('success', 'Tutor created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.tutors.index')->with('error', 'Failed to create tutor.');
        }
    }

    /**
     * @param Request $request
     * @param Tutor $tutor
     * @return RedirectResponse
     */
    public function update(Request $request, Tutor $tutor): RedirectResponse
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$tutor->user_id,
            'date_of_birth' => 'required|date|before:'.Carbon::now()->subYears(18)->format('Y-m-d'),
        ]);

        try {
            DB::transaction(function () use ($tutor, $validatedData) {
                $tutor->user()->update([
                    'first_name' => $validatedData['first_name'],
                    'last_name' => $validatedData['last_name'],
                    'middle_name' => $validatedData['middle_name'],
                    'email' => $validatedData['email'],
                    'password' => bcrypt(time()),
                    'date_of_birth' => $validatedData['date_of_birth'],
                ]);
            });
            return redirect()->route('dashboard.tutors.index')->with('success', 'Tutor updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.tutors.index')->with('error', 'Failed to update tutor.');
        }
    }

    /**
     * @param Tutor $tutor
     * @return RedirectResponse
     */
    public function destroy(Tutor $tutor): RedirectResponse
    {
        try {
            DB::transaction(function () use ($tutor) {
                $tutor->user()->delete();
            });
            return redirect()->route('dashboard.tutors.index')->with('success', 'Tutor deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.tutors.index')->with('error', 'Failed to delete tutor.');
        }
    }
}

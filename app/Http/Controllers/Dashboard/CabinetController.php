<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cabinet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CabinetController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.cabinets.index', [
            'cabinets' => Cabinet::query()->paginate(10),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.cabinets.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'code' => ['required', 'string', 'max:255', Rule::unique(Cabinet::class)],
        ]);

        try {
            DB::transaction(function () use ($validatedData) {
                Cabinet::query()->create($validatedData);
            });
            return redirect()->route('dashboard.cabinets.index')->with('success', 'Cabinet created successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.cabinets.index')->with('error', 'Failed to create cabinet.');
        }
    }

    /**
     * @param Cabinet $cabinet
     * @return View
     */
    public function edit(Cabinet $cabinet): View
    {
        return view('dashboard.cabinets.edit', [
            'cabinet' => $cabinet,
        ]);
    }

    /**
     * @param Request $request
     * @param Cabinet $cabinet
     * @return RedirectResponse
     */
    public function update(Request $request, Cabinet $cabinet): RedirectResponse
    {
        $validatedData = $request->validate([
            'code' => ['required', 'string', 'max:255', Rule::unique(Cabinet::class)->ignore($cabinet->code, 'code')],
        ]);

        try {
            DB::transaction(function () use ($cabinet, $validatedData) {
                $cabinet->update($validatedData);
            });
            return redirect()->route('dashboard.cabinets.index')->with('success', 'Cabinet updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.cabinets.index')->with('error', 'Failed to update cabinet.');
        }
    }

    /**
     * @param Cabinet $cabinet
     * @return RedirectResponse
     */
    public function destroy(Cabinet $cabinet): RedirectResponse
    {
        try {
            DB::transaction(function () use ($cabinet) {
                $cabinet->delete();
            });
            return redirect()->route('dashboard.cabinets.index')->with('success', 'Cabinet deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('dashboard.cabinets.index')->with('error', 'Failed to delete cabinet.');
        }
    }
}

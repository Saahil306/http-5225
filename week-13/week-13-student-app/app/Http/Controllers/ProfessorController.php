<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    /**
     * Display a listing of professors.
     */
    public function index()
    {
        $professors = Professor::all(); // Get all professors
        return view('professors.index', compact('professors'));
    }

    /**
     * Show the form for creating a new professor.
     */
    public function create()
    {
        return view('professors.create');
    }

    /**
     * Store a newly created professor in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            Professor::create($request->all());
            return redirect()->route('professors.index')
                             ->with('success', 'Professor created successfully.');
        } catch (\Exception $e) {
            return back()->withErrors('Error creating professor: '.$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified professor.
     */
    public function edit(Professor $professor)
    {
        return view('professors.edit', compact('professor'));
    }

    /**
     * Update the specified professor in storage.
     */
    public function update(Request $request, Professor $professor)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $professor->update($request->all());
            return redirect()->route('professors.index')
                             ->with('success', 'Professor updated successfully.');
        } catch (\Exception $e) {
            return back()->withErrors('Error updating professor: '.$e->getMessage());
        }
    }

    /**
     * Remove the specified professor from storage.
     */
    public function destroy(Professor $professor)
    {
        try {
            $professor->delete();
            return redirect()->route('professors.index')
                             ->with('success', 'Professor deleted successfully.');
        } catch (\Exception $e) {
            return back()->withErrors('Error deleting professor: '.$e->getMessage());
        }
    }
}

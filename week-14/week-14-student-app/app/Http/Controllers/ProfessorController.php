<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professor;

class ProfessorController extends Controller
{
    /**
     * Display a listing of the professors.
     */
    public function index()
    {
        $professors = Professor::all();
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
        // Validation
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:professors,email',
        ]);

        // Create professor
        Professor::create($request->all());

        return redirect()->route('professors.index')->with('success', 'Professor added successfully.');
    }

    /**
     * Show the form for editing the specified professor.
     */
    public function edit($id)
    {
        $professor = Professor::findOrFail($id);
        return view('professors.edit', compact('professor'));
    }

    /**
     * Update the specified professor in storage.
     */
    public function update(Request $request, $id)
    {
        $professor = Professor::findOrFail($id);

        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:professors,email,' . $professor->id,
        ]);

        $professor->update($request->all());

        return redirect()->route('professors.index')->with('success', 'Professor updated successfully.');
    }

    /**
     * Remove the specified professor from storage.
     */
    public function destroy($id)
    {
        $professor = Professor::findOrFail($id);
        $professor->delete();

        return redirect()->route('professors.index')->with('success', 'Professor deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\Selfevaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelfevaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $selfevaluations = Selfevaluation::where('user_id', $userId)->with('evaluation')->get();
    
        return view('selfevaluations.index', compact('selfevaluations'));
    }
    
    public function create($evaluationId)
    {
        $userId = Auth::id();
        $evaluation = Evaluation::findOrFail($evaluationId); // Encuentra la evaluación o lanza un error 404
        $selfevaluation = Selfevaluation::where('evaluation_id', $evaluationId)
                                         ->where('user_id', $userId)
                                         ->firstOrFail();
    
        return view('selfevaluations.create', compact('evaluation', 'selfevaluation'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'evaluation_id' => 'required|exists:evaluations,id',
            'user_id' => 'required|exists:users,id',
            'nota' => 'required|integer|min:0|max:100',
        ]);
    
        $selfevaluation = Selfevaluation::where('evaluation_id', $request->input('evaluation_id'))
                                         ->where('user_id', $request->input('user_id'))
                                         ->firstOrFail();
    
        $selfevaluation->update([
            'nota' => $request->input('nota'),
        ]);
    
        return redirect()->route('selfevaluations.index')->with('success', 'Autoevaluación registrada correctamente.');
    }
    
    
    
    /**
     * Display the specified resource.
     */
    public function show(Selfevaluation $selfevaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Selfevaluation $selfevaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Selfevaluation $selfevaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Selfevaluation $selfevaluation)
    {
        //
    }
}

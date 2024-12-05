<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\GroupMemberEvaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMemberEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $evaluations = GroupMemberEvaluation::where('evaluator_id', $userId)->with(['evaluatee', 'evaluation'])->get();
    
        return view('group_member_evaluations.index', compact('evaluations'));
    }
    
    public function create($evaluationId, $evaluateeId)
    {
        $userId = Auth::id();
        $groupMemberEvaluation = GroupMemberEvaluation::where('evaluation_id', $evaluationId)
                                                        ->where('evaluator_id', $userId)
                                                        ->where('evaluatee_id', $evaluateeId)
                                                        ->with('evaluatee')
                                                        ->firstOrFail();
    
        return view('group_member_evaluations.create', compact('groupMemberEvaluation'));
    }
    
    
    public function store(Request $request)
    {
        $request->validate([
            'evaluations.*.evaluation_id' => 'required|exists:evaluations,id',
            'evaluations.*.evaluator_id' => 'required|exists:users,id',
            'evaluations.*.evaluatee_id' => 'required|exists:users,id',
            'evaluations.*.nota' => 'required|integer|min:0|max:100',
        ]);
    
        foreach ($request->input('evaluations') as $evaluationData) {
            $evaluation = Evaluation::findOrFail($evaluationData['evaluation_id']);
            
            if ($evaluationData['nota'] > $evaluation->peso) {
                return back()->withErrors(['nota' => "La nota no puede exceder el peso máximo de {$evaluation->peso}."]);
            }
    
            $groupMemberEvaluation = GroupMemberEvaluation::where('evaluation_id', $evaluationData['evaluation_id'])
                                                          ->where('evaluator_id', $evaluationData['evaluator_id'])
                                                          ->where('evaluatee_id', $evaluationData['evaluatee_id'])
                                                          ->firstOrFail();
    
            $groupMemberEvaluation->update([
                'nota' => $evaluationData['nota'],
            ]);
        }
    
        return redirect()->route('group_member_evaluations.index')->with('success', 'Evaluaciones registradas correctamente.');
    }
    
    

    /**
     * Display the specified resource.
     */
    public function show(GroupMemberEvaluation $groupMemberEvaluation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupMemberEvaluation $groupMemberEvaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupMemberEvaluation $groupMemberEvaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupMemberEvaluation $groupMemberEvaluation)
    {
        //
    }
}

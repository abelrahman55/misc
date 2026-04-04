<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SpecialtyQuestion;
use App\Models\Specialty;
use App\Http\Requests\Web\AddSpecialtyQuestionRequest;
use Illuminate\Http\Request;

class SpecialtyQuestionsController extends Controller
{
    public function index()
    {
        $questions = SpecialtyQuestion::paginate(10);
        return view('SpecialtyQuestions.index', compact('questions'));
    }

    public function create()
    {
        return view('SpecialtyQuestions.create');
    }

    public function store(AddSpecialtyQuestionRequest $request)
    {
        SpecialtyQuestion::create($request->validated());
        return redirect()->route('specialty-questions.index')->with('success', 'Question added successfully');
    }

    public function edit($id)
    {
        $question = SpecialtyQuestion::findOrFail($id);
        return view('SpecialtyQuestions.edit', compact('question'));
    }

    public function update(AddSpecialtyQuestionRequest $request, $id)
    {
        $question = SpecialtyQuestion::findOrFail($id);
        $question->update($request->validated());
        return redirect()->route('specialty-questions.index')->with('success', 'Question updated successfully');
    }

    public function destroy($id)
    {
        $question = SpecialtyQuestion::findOrFail($id);
        $question->delete();
        return redirect()->back()->with('success', 'Question deleted successfully');
    }
}

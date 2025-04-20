<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $specialization = $request->query('specialization');
        $query = Question::with('specialization');

        if ($specialization) {
            $query->whereHas('specialization', function ($q) use ($specialization) {
                $q->where('name', $specialization);
            });
        }

        $questions = $query->paginate(15);

        return view('student.questions.index', compact('questions', 'specialization'));
    }

    public function show(Question $question)
    {
        return view('student.questions.show', compact('question'));
    }

    public function answer(Request $request, Question $question)
    {
        $request->validate([
            'answer' => 'required|string',
        ]);

        $user = Auth::user();
        $specialization_id = $question->specialization_id;

        $progress = Progress::firstOrCreate(
            ['user_id' => $user->id, 'specialization_id' => $specialization_id],
            ['questions_answered' => 0, 'correct_answers' => 0]
        );

        $progress->questions_answered += 1;

        // Simple correctness check (case insensitive)
        if (trim(strtolower($request->answer)) === trim(strtolower($question->answer))) {
            $progress->correct_answers += 1;
        }

        $progress->save();

        return redirect()->route('student.questions.show', $question)->with('status', 'Answer submitted.');
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::where('is_active', true)
            ->withCount('questions')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $quizzes
        ]);
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions')->find($id);

        if (!$quiz || !$quiz->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz not found'
            ], 404);
        }

        // Remove correct answers from questions for security
        $quiz->questions->each(function ($question) {
            unset($question->correct_answer);
            unset($question->explanation);
        });

        return response()->json([
            'success' => true,
            'data' => $quiz
        ]);
    }

    public function startQuiz($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz || !$quiz->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz not found'
            ], 404);
        }

        $attempt = QuizAttempt::create([
            'user_id' => auth()->id(),
            'quiz_id' => $quiz->id,
            'answers' => [],
            'score' => 0,
            'total_questions' => $quiz->questions()->count(),
            'correct_answers' => 0,
            'is_passed' => false,
            'started_at' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quiz started successfully',
            'data' => [
                'attempt_id' => $attempt->id,
                'quiz' => $quiz->load('questions')
            ]
        ], 201);
    }

    public function submitQuiz(Request $request, $attemptId)
    {
        $attempt = QuizAttempt::where('user_id', auth()->id())
            ->where('id', $attemptId)
            ->first();

        if (!$attempt) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz attempt not found'
            ], 404);
        }

        if ($attempt->completed_at) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz already submitted'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'answers' => 'required|array',
            'answers.*' => 'required|string|in:A,B,C,D',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $quiz = Quiz::with('questions')->find($attempt->quiz_id);
        $userAnswers = $request->answers;
        $correctAnswers = 0;
        $totalScore = 0;

        foreach ($quiz->questions as $question) {
            $questionId = $question->id;
            $userAnswer = $userAnswers[$questionId] ?? null;

            if ($userAnswer === $question->correct_answer) {
                $correctAnswers++;
                $totalScore += $question->points;
            }
        }

        $percentageScore = ($correctAnswers / $quiz->questions->count()) * 100;
        $isPassed = $percentageScore >= $quiz->passing_score;

        $attempt->update([
            'answers' => $userAnswers,
            'score' => $percentageScore,
            'correct_answers' => $correctAnswers,
            'is_passed' => $isPassed,
            'completed_at' => now(),
            'time_taken_seconds' => now()->diffInSeconds($attempt->started_at),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Quiz submitted successfully',
            'data' => [
                'score' => $percentageScore,
                'correct_answers' => $correctAnswers,
                'total_questions' => $quiz->questions->count(),
                'is_passed' => $isPassed,
                'passing_score' => $quiz->passing_score,
                'time_taken' => $attempt->time_taken_seconds,
            ]
        ]);
    }

    public function getResults($attemptId)
    {
        $attempt = QuizAttempt::where('user_id', auth()->id())
            ->with(['quiz.questions'])
            ->find($attemptId);

        if (!$attempt) {
            return response()->json([
                'success' => false,
                'message' => 'Quiz attempt not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $attempt
        ]);
    }

    public function getUserAttempts()
    {
        $attempts = QuizAttempt::where('user_id', auth()->id())
            ->with('quiz')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $attempts
        ]);
    }
}

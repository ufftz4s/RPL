<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\ConsultationController;
use App\Http\Controllers\Api\FinancialRecordController;
use App\Http\Controllers\Api\SavingsTargetController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\ChatbotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes (tidak perlu authentication)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Public content routes
Route::get('/courses', [CourseController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{id}', [ArticleController::class, 'show']);
Route::get('/articles/category/{category}', [ArticleController::class, 'getByCategory']);
Route::get('/quizzes', [QuizController::class, 'index']);
Route::get('/quizzes/{id}', [QuizController::class, 'show']);

// Protected routes (perlu authentication)
Route::middleware('auth:sanctum')->group(function () {

    // Auth routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    // Consultation additional routes
    Route::post('/consultations/{id}/payment', [ConsultationController::class, 'updatePaymentStatus']);
    Route::post('/consultations/{id}/review', [ConsultationController::class, 'addReview']);

    // Course management (admin only - nanti akan ditambah middleware admin)
    Route::post('/courses', [CourseController::class, 'store']);
    Route::put('/courses/{id}', [CourseController::class, 'update']);
    Route::delete('/courses/{id}', [CourseController::class, 'destroy']);

    // Article management (admin/author only)
    Route::post('/articles', [ArticleController::class, 'store']);
    Route::put('/articles/{id}', [ArticleController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);

    // Consultation routes
    Route::apiResource('consultations', ConsultationController::class);

    // Financial Records routes
    Route::apiResource('financial-records', FinancialRecordController::class);
    Route::get('/financial-summary', [FinancialRecordController::class, 'summary']);

    // Savings Target routes
    Route::apiResource('savings-targets', SavingsTargetController::class);
    Route::post('/savings-targets/{id}/progress', [SavingsTargetController::class, 'addProgress']);
    Route::post('/calculate-target', [SavingsTargetController::class, 'calculateTarget']);

    // Quiz routes
    Route::post('/quizzes/{id}/start', [QuizController::class, 'startQuiz']);
    Route::post('/quiz-attempts/{attemptId}/submit', [QuizController::class, 'submitQuiz']);
    Route::get('/quiz-attempts/{attemptId}/results', [QuizController::class, 'getResults']);
    Route::get('/my-quiz-attempts', [QuizController::class, 'getUserAttempts']);

    // Chatbot routes
    Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage']);
    Route::get('/chatbot/history', [ChatbotController::class, 'getHistory']);
});

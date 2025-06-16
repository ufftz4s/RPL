<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SavingsTarget;
use App\Models\SavingsProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SavingsTargetController extends Controller
{
    public function index()
    {
        $targets = SavingsTarget::where('user_id', auth()->id())
            ->with('progress')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $targets
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:1',
            'frequency' => 'required|in:daily,weekly,monthly',
            'frequency_amount' => 'required|numeric|min:1',
            'target_date' => 'required|date|after:today',
            'start_date' => 'required|date',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $data = $request->all();
        $data['user_id'] = auth()->id();

        $target = SavingsTarget::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Savings target created successfully',
            'data' => $target
        ], 201);
    }

    public function show($id)
    {
        $target = SavingsTarget::where('user_id', auth()->id())
            ->with('progress')
            ->find($id);

        if (!$target) {
            return response()->json([
                'success' => false,
                'message' => 'Savings target not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $target
        ]);
    }

    public function update(Request $request, $id)
    {
        $target = SavingsTarget::where('user_id', auth()->id())->find($id);

        if (!$target) {
            return response()->json([
                'success' => false,
                'message' => 'Savings target not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'target_amount' => 'numeric|min:1',
            'frequency' => 'in:daily,weekly,monthly',
            'frequency_amount' => 'numeric|min:1',
            'target_date' => 'date|after:today',
            'start_date' => 'date',
            'status' => 'in:active,completed,paused',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $target->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Savings target updated successfully',
            'data' => $target
        ]);
    }

    public function destroy($id)
    {
        $target = SavingsTarget::where('user_id', auth()->id())->find($id);

        if (!$target) {
            return response()->json([
                'success' => false,
                'message' => 'Savings target not found'
            ], 404);
        }

        $target->delete();

        return response()->json([
            'success' => true,
            'message' => 'Savings target deleted successfully'
        ]);
    }

    public function addProgress(Request $request, $id)
    {
        $target = SavingsTarget::where('user_id', auth()->id())->find($id);

        if (!$target) {
            return response()->json([
                'success' => false,
                'message' => 'Savings target not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'saved_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $progress = SavingsProgress::create([
            'savings_target_id' => $target->id,
            'amount' => $request->amount,
            'saved_date' => $request->saved_date,
            'notes' => $request->notes,
        ]);

        // Update current amount
        $target->current_amount += $request->amount;

        // Check if target is completed
        if ($target->current_amount >= $target->target_amount) {
            $target->status = 'completed';
        }

        $target->save();

        return response()->json([
            'success' => true,
            'message' => 'Progress added successfully',
            'data' => [
                'progress' => $progress,
                'target' => $target->fresh()
            ]
        ], 201);
    }

    public function calculateTarget(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'target_amount' => 'required|numeric|min:1',
            'target_date' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $targetAmount = $request->target_amount;
        $targetDate = \Carbon\Carbon::parse($request->target_date);
        $today = \Carbon\Carbon::today();

        $totalDays = $today->diffInDays($targetDate);
        $totalWeeks = $today->diffInWeeks($targetDate);
        $totalMonths = $today->diffInMonths($targetDate);

        $dailyAmount = $totalDays > 0 ? $targetAmount / $totalDays : 0;
        $weeklyAmount = $totalWeeks > 0 ? $targetAmount / $totalWeeks : 0;
        $monthlyAmount = $totalMonths > 0 ? $targetAmount / $totalMonths : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'target_amount' => $targetAmount,
                'target_date' => $targetDate->format('Y-m-d'),
                'days_remaining' => $totalDays,
                'weeks_remaining' => $totalWeeks,
                'months_remaining' => $totalMonths,
                'daily_amount' => round($dailyAmount, 2),
                'weekly_amount' => round($weeklyAmount, 2),
                'monthly_amount' => round($monthlyAmount, 2),
            ]
        ]);
    }
}

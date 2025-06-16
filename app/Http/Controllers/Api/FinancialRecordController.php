<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinancialRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinancialRecordController extends Controller
{
    public function index(Request $request)
    {
        $query = FinancialRecord::where('user_id', auth()->id());

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('start_date')) {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }

        if ($request->has('end_date')) {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }

        $records = $query->orderBy('transaction_date', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $records
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'description' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string',
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

        $record = FinancialRecord::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Financial record created successfully',
            'data' => $record
        ], 201);
    }

    public function show($id)
    {
        $record = FinancialRecord::where('user_id', auth()->id())->find($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Financial record not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $record
        ]);
    }

    public function update(Request $request, $id)
    {
        $record = FinancialRecord::where('user_id', auth()->id())->find($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Financial record not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'type' => 'in:income,expense',
            'category' => 'string|max:255',
            'description' => 'string',
            'amount' => 'numeric|min:0',
            'transaction_date' => 'date',
            'payment_method' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $record->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Financial record updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($id)
    {
        $record = FinancialRecord::where('user_id', auth()->id())->find($id);

        if (!$record) {
            return response()->json([
                'success' => false,
                'message' => 'Financial record not found'
            ], 404);
        }

        $record->delete();

        return response()->json([
            'success' => true,
            'message' => 'Financial record deleted successfully'
        ]);
    }

    public function summary()
    {
        $userId = auth()->id();

        $totalIncome = FinancialRecord::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = FinancialRecord::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        $balance = $totalIncome - $totalExpense;

        return response()->json([
            'success' => true,
            'data' => [
                'total_income' => $totalIncome,
                'total_expense' => $totalExpense,
                'balance' => $balance
            ]
        ]);
    }
}

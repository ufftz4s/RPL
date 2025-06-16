<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    public function index(Request $request)
    {
        $query = Consultation::where('user_id', auth()->id());

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $consultations = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $consultations
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'consultation_type' => 'required|in:chat,video_call,whatsapp',
            'topic' => 'required|string|max:255',
            'description' => 'required|string',
            'scheduled_at' => 'nullable|date|after:now',
            'duration_minutes' => 'nullable|integer|min:15|max:120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        // Set price based on consultation type
        $prices = [
            'chat' => 50000,
            'video_call' => 100000,
            'whatsapp' => 75000,
        ];

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $data['price'] = $prices[$request->consultation_type];
        $data['duration_minutes'] = $request->duration_minutes ?? 30;

        $consultation = Consultation::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Consultation request created successfully',
            'data' => $consultation
        ], 201);
    }

    public function show($id)
    {
        $consultation = Consultation::where('user_id', auth()->id())->find($id);

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $consultation
        ]);
    }

    public function update(Request $request, $id)
    {
        $consultation = Consultation::where('user_id', auth()->id())->find($id);

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], 404);
        }

        // Only allow updates if consultation is still pending
        if ($consultation->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot update consultation that is not pending'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'consultation_type' => 'in:chat,video_call,whatsapp',
            'topic' => 'string|max:255',
            'description' => 'string',
            'scheduled_at' => 'nullable|date|after:now',
            'duration_minutes' => 'nullable|integer|min:15|max:120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $consultation->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Consultation updated successfully',
            'data' => $consultation
        ]);
    }

    public function destroy($id)
    {
        $consultation = Consultation::where('user_id', auth()->id())->find($id);

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], 404);
        }

        // Only allow deletion if consultation is pending
        if ($consultation->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot delete consultation that is not pending'
            ], 400);
        }

        $consultation->delete();

        return response()->json([
            'success' => true,
            'message' => 'Consultation deleted successfully'
        ]);
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $consultation = Consultation::where('user_id', auth()->id())->find($id);

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'payment_status' => 'required|in:paid,failed',
            'payment_method' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $consultation->update([
            'payment_status' => $request->payment_status,
            'payment_method' => $request->payment_method,
            'status' => $request->payment_status === 'paid' ? 'paid' : 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment status updated successfully',
            'data' => $consultation
        ]);
    }

    public function addReview(Request $request, $id)
    {
        $consultation = Consultation::where('user_id', auth()->id())->find($id);

        if (!$consultation) {
            return response()->json([
                'success' => false,
                'message' => 'Consultation not found'
            ], 404);
        }

        if ($consultation->status !== 'completed') {
            return response()->json([
                'success' => false,
                'message' => 'Can only review completed consultations'
            ], 400);
        }

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $consultation->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review added successfully',
            'data' => $consultation
        ]);
    }
}

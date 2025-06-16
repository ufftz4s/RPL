<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatbotConversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string|max:1000',
            'conversation_type' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $userMessage = $request->message;

        // Simple chatbot logic (nanti bisa diganti dengan AI yang lebih advanced)
        $botResponse = $this->generateBotResponse($userMessage);

        $conversation = ChatbotConversation::create([
            'user_id' => auth()->id(),
            'user_message' => $userMessage,
            'bot_response' => $botResponse,
            'conversation_type' => $request->conversation_type ?? 'financial_advice',
            'context' => $request->context ?? null,
        ]);

        return response()->json([
            'success' => true,
            'data' => [
                'user_message' => $userMessage,
                'bot_response' => $botResponse,
                'conversation_id' => $conversation->id,
            ]
        ]);
    }

    public function getHistory()
    {
        $conversations = ChatbotConversation::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->limit(50)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $conversations
        ]);
    }

    private function generateBotResponse($message)
    {
        $message = strtolower($message);

        // Simple keyword-based responses
        if (str_contains($message, 'budget') || str_contains($message, 'anggaran')) {
            return "Untuk membuat anggaran yang baik, ikuti aturan 50-30-20: 50% untuk kebutuhan pokok, 30% untuk keinginan, dan 20% untuk tabungan dan investasi. Mulailah dengan mencatat semua pemasukan dan pengeluaran Anda.";
        }

        if (str_contains($message, 'tabung') || str_contains($message, 'saving')) {
            return "Tips menabung: 1) Otomatiskan tabungan, 2) Mulai dengan jumlah kecil tapi konsisten, 3) Buat tujuan yang spesifik, 4) Hindari pengeluaran impulsif. Bahkan menabung Rp 10.000 per hari sudah sangat baik!";
        }

        if (str_contains($message, 'hutang') || str_contains($message, 'debt') || str_contains($message, 'utang')) {
            return "Untuk mengelola hutang: 1) Buat daftar semua hutang, 2) Prioritaskan hutang dengan bunga tertinggi, 3) Bayar minimal di semua hutang, lalu fokus bayar lebih di hutang prioritas, 4) Hindari menambah hutang baru.";
        }

        if (str_contains($message, 'investasi') || str_contains($message, 'invest')) {
            return "Untuk pemula, mulai dengan: 1) Reksadana sebagai pilihan yang mudah dan terdiversifikasi, 2) Investasi minimal Rp 100.000, 3) Pilih manajer investasi terpercaya, 4) Investasi rutin setiap bulan, 5) Jangan panik saat nilai turun.";
        }

        if (str_contains($message, 'darurat') || str_contains($message, 'emergency')) {
            return "Dana darurat sangat penting! Idealnya 6-12 bulan pengeluaran bulanan. Simpan di tabungan yang mudah diakses. Mulai dengan target 1 bulan pengeluaran dulu, lalu tingkatkan bertahap.";
        }

        // Default response
        return "Terima kasih atas pertanyaan Anda tentang keuangan. Saya dapat membantu dengan topik budget, tabungan, hutang, investasi, dan dana darurat. Bisa dijelaskan lebih detail apa yang ingin Anda ketahui?";
    }
}

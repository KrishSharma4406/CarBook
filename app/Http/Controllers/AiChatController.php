<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiChatController extends Controller
{
    /**
     * Send a message directly to Ollama and return Ollama's response.
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $userMessage = $request->input('message');
        $history = $request->input('history', []);

        // System prompt for Ollama
        $messages = [
            [
                'role' => 'system',
                'content' => 'You are CarBook AI Assistant — a helpful, friendly, and concise assistant for the CarBook ride-sharing and car rental platform. Help users with questions about booking rides, offering rides, managing their cars, profile settings, payments, and general platform usage. Keep answers short and helpful. If you don\'t know something specific about the platform, provide general guidance.'
            ]
        ];

        // Add conversation history
        $history = array_slice($history, -10);
        foreach ($history as $msg) {
            if (isset($msg['role']) && isset($msg['content'])) {
                $messages[] = [
                    'role' => $msg['role'],
                    'content' => $msg['content'],
                ];
            }
        }

        // Add current user message
        $messages[] = [
            'role' => 'user',
            'content' => $userMessage,
        ];

        try {
            $ollamaUrl = rtrim(config('ai.providers.ollama.url', 'http://localhost:11434'), '/');
            $model = env('OLLAMA_MODEL', 'llama3.2');

            $response = Http::timeout(120)->post("{$ollamaUrl}/api/chat", [
                'model' => $model,
                'messages' => $messages,
                'stream' => false,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'reply' => $data['message']['content'] ?? '',
                ]);
            }

            return response()->json([
                'success' => false,
                'error' => 'Ollama HTTP Error: ' . $response->status(),
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Ollama Exception: ' . $e->getMessage(),
            ], 500);
        }
    }
}

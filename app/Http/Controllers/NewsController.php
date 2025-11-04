<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NewsController extends Controller
{
    /** 📰 Show all news */
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    /** 📰 Create view */
    public function create()
    {
        return view('news.create');
    }

    /** 📰 Store new article */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|boolean',
        ]);

        News::create($validated);
        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    /** 📰 Edit view */
    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    /** 📰 Update existing article */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|boolean',
        ]);

        $news->update($validated);
        return redirect()->route('news.index')->with('success', 'News updated successfully.');
    }

    /** 🗑 Delete article */
    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }

    /** 🤖 Generate AI-based article */
    public function generateNews(Request $request)
    {
        $title = trim($request->query('title', ''));

        if ($title === '') {
            return response()->json(['error' => 'Missing title'], 400);
        }

        $apiKey = env('OPENROUTER_API_KEY');
        if (!$apiKey) {
            return response()->json(['error' => 'Missing OpenRouter API key'], 500);
        }

        try {
            // 🚀 Make prompt concise & efficient
            $prompt = <<<PROMPT
You are a professional journalist. Write a detailed, factual news article titled:
"$title"

Requirements:
- Minimum 6 paragraphs (700+ words)
- Start with a 2-sentence summary
- Add background, quotes, expert analysis, and future implications
- Maintain a neutral, professional tone (like BBC or Reuters)
PROMPT;

            // ⚡ Use persistent connection, short timeout
            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => "Bearer {$apiKey}",
                    'HTTP-Referer'  => url('/'),
                    'Content-Type'  => 'application/json',
                ])
                ->post('https://openrouter.ai/api/v1/chat/completions', [
                    'model' => 'meta-llama/llama-3-8b-instruct', // Faster & richer than Mistral
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a professional journalist writing factual long-form news.'],
                        ['role' => 'user', 'content' => $prompt],
                    ],
                    'max_tokens'  => 1400,
                    'temperature' => 0.65,
                ]);

            if (!$response->ok()) {
                return response()->json(['error' => 'AI API request failed', 'status' => $response->status()], 500);
            }

            $data = $response->json();
            $content = $data['choices'][0]['message']['content'] ?? '⚠️ Could not generate news content.';

            return response()->json(['content' => trim($content)]);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Request failed: ' . $e->getMessage()
            ], 500);
        }
    }
}

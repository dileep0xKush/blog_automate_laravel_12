<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('news', NewsController::class);
Route::get('/generate-news', [NewsController::class, 'generateNews']);

Route::get('/test-free', function () {
    $response = Http::withHeaders([
        'api-key' => env('DEEPAI_API_KEY'),
    ])->post('https://api.deepai.org/api/text-generator', [
        'text' => 'Write a 3-paragraph news article about ',
    ]);


    return $response->json();
});


Route::get('/generate-free-news', function (\Illuminate\Http\Request $request) {
    $title = $request->query('title', 'Latest Tech Innovation');
    $prompt = "Write a 3-paragraph neutral news article titled: \"$title\"";

    // ✅ Alternate active free Space (as of 2025)
    $url = "https://hf-chatbot.hf.space/run/predict";

    try {
        $response = Http::timeout(90)->post($url, [
            'data' => [$prompt]
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Free AI model unavailable'], 500);
        }

        $data = $response->json();
        $content = $data['data'][0] ?? "⚠️ The free AI could not generate content.";

        return response()->json(['content' => trim($content)]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Connection failed: ' . $e->getMessage()], 500);
    }
});

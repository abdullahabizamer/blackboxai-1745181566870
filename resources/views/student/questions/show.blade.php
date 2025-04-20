@extends('layouts.app')

@section('title', 'عرض السؤال')

@section('content')
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
    <h1 class="text-xl font-bold mb-4">السؤال</h1>
    <p class="mb-4 text-right">{{ $question->question_text }}</p>

    <form action="{{ route('student.questions.answer', $question) }}" method="POST" class="mb-4">
        @csrf
        <label for="answer" class="block mb-2 font-semibold">إجابتك:</label>
        <textarea name="answer" id="answer" rows="4" class="w-full border border-gray-300 rounded p-2" required>{{ old('answer') }}</textarea>
        @error('answer')
            <p class="text-red-600 mt-1">{{ $message }}</p>
        @enderror
        <button type="submit" class="mt-3 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">إرسال الإجابة</button>
    </form>

    @if(session('status'))
        <div class="bg-green-100 text-green-700 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    @if($question->answer)
        <div class="mt-6 p-4 bg-gray-100 rounded">
            <h2 class="font-semibold mb-2">الإجابة النموذجية:</h2>
            <p>{{ $question->answer }}</p>
        </div>
    @endif
</div>
@endsection

@extends('layouts.app')

@section('title', 'تعديل السؤال')

@section('content')
<h1 class="text-2xl font-bold mb-4">تعديل السؤال</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.questions.update', $question) }}" method="POST" class="bg-white p-6 rounded shadow max-w-lg">
    @csrf
    @method('PUT')
    <div class="mb-4">
        <label for="specialization_id" class="block mb-1 font-semibold">التخصص</label>
        <select name="specialization_id" id="specialization_id" class="w-full border border-gray-300 rounded p-2">
            @foreach($specializations as $specialization)
                <option value="{{ $specialization->id }}" {{ $specialization->id == $question->specialization_id ? 'selected' : '' }}>{{ $specialization->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="question_text" class="block mb-1 font-semibold">نص السؤال</label>
        <textarea name="question_text" id="question_text" rows="4" class="w-full border border-gray-300 rounded p-2" required>{{ old('question_text', $question->question_text) }}</textarea>
    </div>

    <div class="mb-4">
        <label for="answer" class="block mb-1 font-semibold">الإجابة (اختياري)</label>
        <textarea name="answer" id="answer" rows="3" class="w-full border border-gray-300 rounded p-2">{{ old('answer', $question->answer) }}</textarea>
    </div>

    <div class="mb-4">
        <label for="year" class="block mb-1 font-semibold">السنة (اختياري)</label>
        <input type="text" name="year" id="year" class="w-full border border-gray-300 rounded p-2" value="{{ old('year', $question->year) }}">
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">تحديث السؤال</button>
</form>
@endsection

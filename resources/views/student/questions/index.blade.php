@extends('layouts.app')

@section('title', 'الأسئلة')

@section('content')
<h1 class="text-2xl font-bold mb-4">الأسئلة</h1>

<form method="GET" action="{{ route('student.questions.index') }}" class="mb-4">
    <label for="specialization" class="mr-2 font-semibold">التخصص:</label>
    <select name="specialization" id="specialization" onchange="this.form.submit()" class="border border-gray-300 rounded p-2">
        <option value="">الكل</option>
        @foreach(['هندسة البرمجيات', 'هندسة الشبكات', 'الذكاء الاصطناعي', 'التخصص العام'] as $spec)
            <option value="{{ $spec }}" {{ request('specialization') == $spec ? 'selected' : '' }}>{{ $spec }}</option>
        @endforeach
    </select>
</form>

@if($questions->count() == 0)
    <p>لا توجد أسئلة في هذا التخصص.</p>
@else
    <ul class="space-y-4">
        @foreach($questions as $question)
            <li class="bg-white p-4 rounded shadow">
                <a href="{{ route('student.questions.show', $question) }}" class="text-blue-600 hover:underline">
                    {{ Str::limit($question->question_text, 200) }}
                </a>
                <div class="text-gray-500 text-sm mt-1">السنة: {{ $question->year ?? '-' }}</div>
            </li>
        @endforeach
    </ul>

    <div class="mt-4">
        {{ $questions->appends(request()->query())->links() }}
    </div>
@endif
@endsection

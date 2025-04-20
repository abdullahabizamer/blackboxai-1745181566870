@extends('layouts.app')

@section('title', 'تتبع التقدم')

@section('content')
<h1 class="text-2xl font-bold mb-4">تتبع التقدم</h1>

@if($progress->isEmpty())
    <p>لم يتم تسجيل أي تقدم بعد.</p>
@else
    <table class="w-full bg-white rounded shadow overflow-hidden">
        <thead class="bg-blue-600 text-white">
            <tr>
                <th class="p-3 text-right">التخصص</th>
                <th class="p-3 text-right">عدد الأسئلة التي تم الإجابة عليها</th>
                <th class="p-3 text-right">عدد الإجابات الصحيحة</th>
                <th class="p-3 text-right">النسبة المئوية</th>
            </tr>
        </thead>
        <tbody>
            @foreach($progress as $item)
                <tr class="border-b">
                    <td class="p-3 text-right">{{ $item->specialization->name }}</td>
                    <td class="p-3 text-right">{{ $item->questions_answered }}</td>
                    <td class="p-3 text-right">{{ $item->correct_answers }}</td>
                    <td class="p-3 text-right">
                        @php
                            $percentage = $item->questions_answered > 0 ? round(($item->correct_answers / $item->questions_answered) * 100, 2) : 0;
                        @endphp
                        {{ $percentage }}%
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection

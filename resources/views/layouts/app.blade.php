<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'منصة التعليم الموحدة')</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <header class="bg-blue-700 text-white p-4 shadow">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-bold">منصة امتحان الهندسة المعلوماتية الموحد</a>
            <nav>
                @auth
                    <a href="{{ route('student.questions.index') }}" class="mr-4 hover:underline">الأسئلة</a>
                    <a href="{{ route('student.progress.index') }}" class="mr-4 hover:underline">تقدمي</a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="hover:underline">تسجيل خروج</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-4 hover:underline">تسجيل الدخول</a>
                    <a href="{{ route('register') }}" class="hover:underline">إنشاء حساب</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="flex-grow container mx-auto p-4">
        @yield('content')
    </main>

    <footer class="bg-blue-700 text-white p-4 text-center">
        &copy; 2024 منصة امتحان الهندسة المعلوماتية الموحد
    </footer>
</body>
</html>

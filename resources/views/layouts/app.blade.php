<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'RV Medical')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <nav>
        <a href="{{ route('home') }}">Accueil</a>
    </nav>
</header>

<main>
    @yield('content')
</main>
</body>
</html>

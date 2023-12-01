<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="icon" href="images/favicon.png"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <script src="//unpkg.com/alpinejs" defer></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
      tailwind.config = {
          theme: {
              extend: {
                  colors: {
                      laravel: '#B5B8B1',
                  },
              },
          },
      };
  </script>
  <title>GamesWikipedia</title>
</head>

<body class="mb-48" style="background: #3f454f">
  <nav class="flex justify-between items-center mb-4">
    <a href="/"><img class="w-24 ml-4" src="{{asset('images/logo.png')}}" alt="" class="logo" /></a>
    <ul class="flex space-x-6 mr-6 text-lg">
      @auth
      <li>
        <span class="font-bold uppercase">
          Добро пожаловать! {{auth()->user()->name}}
        </span>
      </li>
      <li>
        <a href="/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Управление обзорами</a>
      </li>
      <li>
        <form class="inline" method="POST" action="/logout">
          @csrf
          <button type="submit" class="hover:text-laravel">
            <i class="fa-solid fa-door-closed"></i> Выйти
          </button>
        </form>
      </li>
      @else
      <li>
        <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Регистрация</a>
      </li>
      <li>
        <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Вход</a>
      </li>
      @endauth
    </ul>
  </nav>

  <main style="background: #3f454f">
    {{$slot}}
  </main>
  <footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-black h-24 mt-24 opacity-90 md:justify-center">
    <p class="ml-2">&copy; 2023, Все права защищены</p>

    <a href="/listings/create" class="absolute top-1/3 right-10 bg-black text-white py-2 px-5">Опубликовать обзор</a>
  </footer>

  <x-flash-message />
</body>

</html>

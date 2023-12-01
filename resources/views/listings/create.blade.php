<x-layout>
  <x-card class="p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
      <h2 class="text-2xl font-bold uppercase mb-1">Создать обзор</h2>
      <p class="mb-4">Разместите ваш обзор на наш сайт</p>
    </header>

    <form method="POST" action="/listings" enctype="multipart/form-data">
      @csrf
      <div class="mb-6">
        <label for="company" class="inline-block text-lg mb-2">Название компании</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="company"
               placeholder="Например: Electronic Arts" value="{{old('company')}}" />

        @error('company')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="title" class="inline-block text-lg mb-2">Название игры</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="title"
          placeholder="Например: Apex Legends" value="{{old('title')}}" />

        @error('title')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="location" class="inline-block text-lg mb-2">Страна где была сделана игра</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
          placeholder="Например: США" value="{{old('location')}}" />

        @error('location')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">
          Связь с вами
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
               placeholder="Например: alex@mail.ru" value="{{old('email')}}" />

        @error('email')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="website" class="inline-block text-lg mb-2">
          URL на покупку игры
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="website"
          value="{{old('website')}}" />

        @error('website')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="tags" class="inline-block text-lg mb-2">
          Жанры (Разделенные запятыми)
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
          placeholder="Например: королевская битва, Шутер от первого лица, геройский шутер и т.д." value="{{old('tags')}}" />

        @error('tags')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="logo" class="inline-block text-lg mb-2">
          Главная картинка игры
        </label>
        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

        @error('logo')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="description" class="inline-block text-lg mb-2">
          Обзор игры
        </label>
          <label>
            <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
                      placeholder="Опишите игру и что в ней нужно делать">{{old('description')}}</textarea>
          </label>

          @error('description')
        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black" style="background: #c41c2f;
        " onmouseover="this.style.backgroundColor='#000'" onmouseout="this.style.backgroundColor='#c41c2f'">
          Создать обзор
        </button>

        <a href="/" class="text-black ml-4"> Назад </a>
      </div>
    </form>
  </x-card>
</x-layout>

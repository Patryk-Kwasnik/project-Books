@extends('layouts.app')

@section('content')
  <h1 class="mb-10 text-2xl">Książki</h1>

  <form method="GET" action="{{ route('books.index') }}" class="mb-4 flex items-center space-x-2">
    <input type="text" name="title" placeholder="Wyszukaj po tytule"
      value="{{ request('title') }}" class="input h-10" />
    <input type="hidden" name="filter" value="{{ request('filter') }}" />
    <button type="submit" class="btn h-10">Wyszukaj</button>
    <a href="{{ route('books.index') }}" class="btn h-10">Wyczyść</a>
  </form>
  <div class="filter-container mb-4 flex">
    @php
      $filters = [
          '' => 'Najnowsze',
          'popular_last_month' => 'Popularne w ostatnim miesiącu',
          'popular_last_6months' => 'Popularne w ostatnich 6 miesiącach',
          'highest_rated_last_month' => 'Najlepiej oceniane w ostatmi miesiącu',
          'highest_rated_last_6months' => 'Najlepiej oceniane w ostatnich 6 miesiącach',
      ];
    @endphp
    @foreach ($filters as $key => $label)
      <a href="{{ route('books.index', ['filter' => $key]) }}"
        class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
        {{ $label }}
      </a>
    @endforeach
  </div>

  <ul>
    @forelse ($books as $book)
      <li class="mb-4">
        <div class="book-item">
          <div
            class="flex flex-wrap items-center justify-between">
            <div class="w-full flex-grow sm:w-auto">
              <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
              <span class="book-author">Autor {{ $book->author }}</span>
            </div>
            <div>
              <div class="book-rating">
                {{ number_format($book->reviews_avg_rating, 1) }}
              </div>
              <div class="book-review-count">
               Ilość opinii: {{ $book->reviews_count }}
              </div>
            </div>
          </div>
        </div>
      </li>
    @empty
      <li class="mb-4">
        <div class="empty-book-item">
          <p class="empty-text">Nie znaleziono książek</p>
          <a href="{{ route('books.index') }}" class="reset-link">Przejdź do strony głównej</a>
        </div>
      </li>
    @endforelse
  </ul>
@endsection
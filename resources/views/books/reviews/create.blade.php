@extends('layouts.app')
@section('content')
  <h1 class="mb-10 text-2xl">Dodaj opinię dla: {{ $book->title }}</h1>
  <form method="POST" action="{{ route('books.reviews.store', $book) }}">
    @csrf
    <label for="review">Opinia:</label>
    <textarea name="review" id="review" required class="input mb-4"></textarea>
    <label for="rating">Ocena:</label>
    <select name="rating" id="rating" class="input mb-4" required>
      <option value="">Wybierz ocenę</option>
      @for ($i = 1; $i <= 5; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
      @endfor
    </select>
    <button type="submit" class="btn">Zapisz opinię</button>
  </form>
@endsection
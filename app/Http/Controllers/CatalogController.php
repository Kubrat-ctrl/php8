<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    // Временное хранилище: в ЛПР № 9 его заменит база данных
    private function movies(): array
    {
        return [
            ['id' => 1, 'code' => 'DR-01', 'title' => 'Левиафан', 'genre' => 'Драма',
             'duration_min' => 141, 'release_date' => '2014-05-23', 'age_rating' => 18, 'is_3d' => false],
            ['id' => 2, 'code' => 'KM-02', 'title' => 'Служебный роман', 'genre' => 'Комедия',
             'duration_min' => 159, 'release_date' => '1977-10-27', 'age_rating' => 12, 'is_3d' => false],
            ['id' => 3, 'code' => 'FN-03', 'title' => 'Притяжение', 'genre' => 'Фантастика',
             'duration_min' => 135, 'release_date' => '2017-01-26', 'age_rating' => 12, 'is_3d' => true],
            ['id' => 4, 'code' => 'DR-04', 'title' => 'Нелюбовь', 'genre' => 'Драма',
             'duration_min' => 127, 'release_date' => '2017-06-01', 'age_rating' => 18, 'is_3d' => false],
            ['id' => 5, 'code' => 'BV-05', 'title' => 'Т-34', 'genre' => 'Боевик',
             'duration_min' => 139, 'release_date' => '2019-01-01', 'age_rating' => 12, 'is_3d' => false],
            ['id' => 6, 'code' => 'TR-06', 'title' => 'Текст', 'genre' => 'Триллер',
             'duration_min' => 129, 'release_date' => '2019-04-11', 'age_rating' => 18, 'is_3d' => false],
            ['id' => 7, 'code' => 'FN-07', 'title' => 'Вратарь Галактики', 'genre' => 'Фантастика',
             'duration_min' => 110, 'release_date' => '2020-01-01', 'age_rating' => 6, 'is_3d' => true],
        ]; // ровно ITEMS = 7 записей
    }

    // GET /catalog?q=...&sort=...
    public function index(Request $request)
    {
        $movies = collect($this->movies());
        $search = $request->query('q');
        if ($search) {
            $movies = $movies->filter(fn ($m) => mb_stripos($m['title'], $search) !== false);
        }

        $sort = $request->query('sort', 'title');
        if (in_array($sort, ['title', 'release_date', 'duration_min'])) {
            $movies = $movies->sortBy($sort);
        }

        return view('catalog.index', [
            'title'  => 'Каталог фильмов',
            'movies' => $movies,
            'search' => $search,
            'sort'   => $sort,
        ]);
    }

    // GET /catalog/3
    public function show(int $id)
    {
        $movie = collect($this->movies())->firstWhere('id', $id);
        abort_if(! $movie, 404);

        return view('catalog.show', ['title' => $movie['title'], 'movie' => $movie]);
    }

    // GET /catalog/code/DR-01
    public function byCode(string $code)
    {
        $movie = collect($this->movies())->firstWhere('code', $code);
        abort_if(! $movie, 404);

        return view('catalog.show', ['title' => $movie['title'], 'movie' => $movie]);
    }

    // GET /catalog/genre/Драма  или  /catalog/genre
    public function byGenre(?string $genre = null)
    {
        $movies = collect($this->movies());
        if ($genre) {
            $movies = $movies->where('genre', $genre);
        }

        return view('catalog.index', [
            'title'  => $genre ? "Фильмы: {$genre}" : 'Все жанры',
            'movies' => $movies,
            'search' => null,
            'sort'   => 'title',
        ]);
    }
}

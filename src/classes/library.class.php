<?php


class Library
{
    public array $booksList;
    public array $filteredBooks;
    public array $genres = [];

    public function __construct(array $booksList)
    {
        $this->booksList = $booksList;
        $this->filteredBooks = $booksList;
        foreach ($this->booksList as $book) {
            $this->genres = array_unique(array_merge($book->genres, $this->genres));
        }
    }

    public function getGenreOccurence($genre)
    {
        $genreCounter = 0;
        foreach ($this->booksList as $book) {
            foreach ($book->genres as $bookGenre) {
                if ($bookGenre === $genre) {
                    # code...
                    $genreCounter++;
                }
            }
        }
        return $genreCounter;
    }

    public function getBookById($id): Book
    {
        foreach ($this->booksList as $book) {
            if ($book->bookId == $id) {
                return $book;
            }
        }
    }

    public function getBooksByGenre($genre): array
    {
        $this->filteredBooks = [];
        foreach ($this->booksList as $book) {
            if (in_array($genre, $book->genres)) {
                $this->filteredBooks[] = $book;
            }
        }
        return $this->filteredBooks;
    }

    public function getGenresSortedByOccurence()
    {
        $genresCountArray = [];

        foreach ($this->genres as $key => $value) {
            $genresCountArray[$value] = $this->getGenreOccurence($value);
        }
        arsort($genresCountArray);
        return $genresCountArray;
    }

    public function getBooksByNames($searchString)
    {
        $this->filteredBooks = [];
        foreach ($this->booksList as $book) {
            if (str_contains(strtolower($book->title), strtolower($searchString))) {
                $this->filteredBooks[] = $book;
            }
        }
        return $this->filteredBooks;
    }
    public function filterBy($type): array
    {
        // Trie et affiche le tableau
        usort($this->filteredBooks, function ($a, $b) use ($type) {
            trim($a->$type);
            trim($b->$type);
            if ($a->$type == $b->$type) {
                return 0;
            }
            if ($type == 'rating') {
                return ($a->$type > $b->$type) ? -1 : 1;
            }
            return ($a->$type < $b->$type) ? -1 : 1;
        });

        return $this->filteredBooks;
    }
}

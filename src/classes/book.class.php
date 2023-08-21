<?php
class Book
{
    public ?string $rank = null;
    public int $bookId;
    public ?string $title = null;
    public ?string $series = null;
    public ?string $numberOfSeries = null;
    public ?string $author = null;
    public ?string $authorLastFirst = null;
    public ?string $description = null;
    public ?string $language = null;
    public $genres = null;
    public ?string $characters = null;
    public ?string $setting = null;
    public ?string $coverImg = null;
    public ?string $bookFormat = null;
    public ?string $edition = null;
    public ?string $pages = null;
    public ?string $publisher = null;
    public ?string $publishedYear = null;
    public ?string $firstPublishYear = null;
    public ?string $awards = null;
    public ?string $rating = null;
    public ?string $numRatings = null;
    public ?string $ISBN = null;
    public ?string $ISBN13 = null;


    function __construct(
        string $rank = null,
        int $bookId = null,
        string $title = null,
        string $series = null,
        string $numberOfSeries = null,
        string $author = null,
        string $authorLastFirst = null,
        string $description = null,
        string $language = null,
        string $genres = null,
        string $characters = null,
        string $setting = null,
        string $coverImg = null,
        string $bookFormat = null,
        string $edition = null,
        string $pages = null,
        string $publisher = null,
        string $publishedYear = null,
        string $firstPublishYear = null,
        string $awards = null,
        string $rating = null,
        string $numRatings = null,
        string $ISBN = null,
        string $ISBN13 = null

    ) {
        $this->rank = $rank;
        $this->bookId = $bookId;
        $this->title = $title;
        $this->series = $series;
        $this->numberOfSeries = $numberOfSeries;
        $this->author = $author;
        $this->authorLastFirst = $authorLastFirst;
        $this->description = $description;
        $this->language = $language;
        $this->genres = array_map("trim", explode(",", $genres));
        $this->characters = $characters;
        $this->setting = $setting;
        $this->coverImg = $coverImg;
        $this->bookFormat = $bookFormat;
        $this->edition = $edition;
        $this->pages = $pages;
        $this->publisher = $publisher;
        $this->publishedYear = $publishedYear;
        $this->firstPublishYear = $firstPublishYear;
        $this->awards = $awards;
        $this->rating = $rating;
        $this->numRatings = $numRatings;
        $this->ISBN = $ISBN;
        $this->ISBN13 = $ISBN13;
    }
}

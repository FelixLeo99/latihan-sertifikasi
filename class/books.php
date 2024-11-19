<?php
include '../config.php';

class Books
{
    public $id;
    public $title;
    public $genre;
    public $author_id;
    public $author_name;
    public $created_at;

    // Constructor
    public function __construct($id = null, $title = null, $genre = null, $author_name = null,  $created_at = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->genre = $genre;
        $this->author_name = $author_name;
        $this->created_at = $created_at;
    }

    // Get all books
    public static function getBuku()
    {
        // Include database connection
        global $conn;

        $books = [];

        try {
            // Query to fetch books with author details
            $query = "SELECT b.id, b.title, b.genre, a.name AS 'author name', b.created_at
                  FROM books b
                  INNER JOIN authors a ON b.author_id = a.id";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Fetch results
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $books[] = new Books(
                    $row['id'],
                    $row['title'],
                    $row['genre'],
                    $row['author name'],  // Assuming you want to store the author's name
                    $row['created_at']
                );
            }
        } catch (PDOException $e) {
            echo "Error fetching books: " . $e->getMessage();
        }

        return $books;
    }

    public static function getBukuById($id)
    {
        global $conn;
        try {
            $query = "SELECT * FROM books WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return new Books(
                $row['id'],
                $row['title'],
                $row['genre'],
                $row['author_id'],
                $row['created_at']
            );
        } catch (PDOException $e) {
            echo "Error fetching book by ID: " . $e->getMessage();
        }
    }
}

<?php
include '../config.php';  // This is correct since authors.php is in the class folder, which is one level below the root folder.

class Authors
{
    public $id;
    public $name;
    public $email;
    public $created_at;

    // Constructor
    public function __construct($id = null, $name = null, $email = null, $created_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->created_at = $created_at;
    }
    public static function getAuthorById($id)
    {
        global $conn;
        try {
            $query = "SELECT id, name, email, created_at FROM authors WHERE id = :id";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Authors($row['id'], $row['name'], $row['email'], $row['created_at']);
            } else {
                return null;  // Tidak ditemukan
            }
        } catch (PDOException $e) {
            echo "Error fetching author: " . $e->getMessage();
        }
    }
    public static function getAuthors()
    {
        global $conn;
        $authors = [];
        try {
            $query = "SELECT id, name, email, created_at FROM authors";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $authors[] = new Authors(
                    $row['id'],
                    $row['name'],
                    $row['email'],
                    $row['created_at']
                );
            }
        } catch (PDOException $e) {
            echo "Error fetching authors: " . $e->getMessage();
        }
        return $authors;
    }

    public static function createAuthor($name, $email)
    {
        global $conn;
        $query = "INSERT INTO authors (name, email) VALUES (:name, :email)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        try {
            $stmt->execute();
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error creating author: " . $e->getMessage();
        }
    }
    public static function updateAuthor($id, $name, $email)
    {
        global $conn;
        $query = "UPDATE authors SET name = :name, email = :email WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error updating author: " . $e->getMessage();
        }
    }
    public static function deleteAuthor($id)
    {
        global $conn;
        $query = "DELETE FROM authors WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error deleting author: " . $e->getMessage();
        }
    }
}

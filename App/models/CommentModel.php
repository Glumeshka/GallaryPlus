<?php
namespace App\models;
use App\core\Model;

class CommentModel extends Model
{
    public function getComment($idN)
    {
        $sql = "SELECT * FROM users
                RIGHT JOIN comments ON users.id = comments.author
                WHERE comments.image_id = $idN";  
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchall(\PDO::FETCH_ASSOC);
        
        return $res; 
    }

    public function addComment($idN)
    {
        $id = $idN[0];
        $form = $_POST;
        $text = $form['comment'];
        $author = $form['id'];       
        $created = (new \DateTime())->format('Y-m-d H:i:s');
        $sql = "INSERT INTO `comments` (image_id, created, text, author) 
                VALUES (:image_id, :created, :text, :author);";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':image_id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':created', $created, \PDO::PARAM_STR);
        $stmt->bindParam(':text', $text, \PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, \PDO::PARAM_INT);
        $stmt->execute();
        header("Location: /Image/id/" . $id);
    }

    public function editComment($idN)
    {
        // когда нибудь...
    }
    
    public function delComment($idN)
    {
        $id = $idN[0];
        $sql = "DELETE FROM comments WHERE comments.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        
        header("Location: /");
    }
}
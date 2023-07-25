<?php
namespace App\models;

use App\core\Model;

class RegisterModel extends Model
{
    public function reg()
    {
        $form = $_POST;
        $id = random_int(0, 1000);
        $username = $form['username'];
        $email = $form['email'];
        $password = password_hash($form['password'], PASSWORD_DEFAULT);
        $password2 = $form['password2'];
        $token = password_hash($form['email'], PASSWORD_DEFAULT);
        $date = (new \DateTime())->format('Y-m-d H:i:s');
        $role = 1;        
        
        $sql = "INSERT INTO users (id, username, email, password, date, token, role)
                VALUES (:id, :username, :email, :password, :date, :token, :role)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':username', $username, \PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, \PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, \PDO::PARAM_STR);
        $stmt->bindParam(':token', $token, \PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, \PDO::PARAM_INT);

        if(password_verify($password2, $password)) {
            $stmt->execute();
            header("Location: /Logon");
        } else {            
            return false;
        }
        // можно проверки по логике добавить
    }   
}
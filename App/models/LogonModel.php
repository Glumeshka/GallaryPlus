<?php
namespace App\models;

use App\core\Model;

class LogonModel extends Model
{
    public function checkUser()
    {
        $currentUsername = $_POST['username'];
        $currentPassword = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = :username";   

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":username", $currentUsername, \PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetch(\PDO::FETCH_ASSOC);
        $userPass = $res["password"];

        if(password_verify($currentPassword, $userPass)) {
            $_SESSION['user'] = $currentUsername;
            $_SESSION['idUser'] = $res['id'];
            $_SESSION['role'] = $res['role'];

            // установка кук по токену, если это необходимо.

            header("Location: /");
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
            $logMessage = "[" . (new \DateTime())->format('Y-m-d H:i:s') . "] Неудачная попытка авторизации для пользователя: " . $currentUsername . " с IP-адресом: " . $ip . "\n";
            file_put_contents(LOGS . "auth.log", $logMessage, FILE_APPEND);          
            return false;
        }
    }

    public function userVK($code)
    {
        // $code = $_GET['code']; // Передайте 'code' параметр в URL обратного вызова
        
        $params = [
            'client_id' => ID_VK,
            'client_secret' => SECRET_VK,
            'redirect_uri' => URL_VK,
            'code' => $code,
        ];

        $token_request = file_get_contents('https://oauth.vk.com/access_token?' . http_build_query($params));
        $token_data = json_decode($token_request, true);
        $access_token = $token_data['access_token'];

        // Запрос информации о пользователе
        $user_params = array(
            'access_token' => $access_token,
            'fields' => 'first_name,last_name',
            'v' => '5.131' // версия API
        );

        $user_request = file_get_contents('https://api.vk.com/method/users.get?' . http_build_query($user_params));
        $user_data = json_decode($user_request, true);
        $user = $user_data['response'][0];

        $_SESSION['user'] = $user["first_name"] . ' ' . $user["last_name"];
        $_SESSION['idUser'] = $user['id'];
        $_SESSION['role'] = 2;

        header("Location: /");
    }
}
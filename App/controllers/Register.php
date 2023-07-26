<?php
namespace App\controllers;
// require_once MODEL . 'RegisterModel.php';
use App\core\Controller;
use App\core\View;
use App\models\RegisterModel;

class Register extends Controller
{ 

    public function __construct()
    {
        $this->model = new RegisterModel();     
        $this->view = new View();
    }

    public function index()
    {
        $this->pageData['title'] = "Регистрация";
        
        if(!empty($_SESSION['user'])) {
            header("Location: /");
        }

        if(!empty($_POST))
        {
            if(!$this->registr())
            {
                $this->pageData['error'] = "Введены некорректные данные!";
            }
        }

        $this->view->render('register.phtml', 'template.phtml', $this->pageData); 
    }

    public function registr()
    {
        if(!$this->model->reg())
        {
            return false;
        }
    }
}
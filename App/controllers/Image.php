<?php
namespace App\controllers;
require_once MODEL . 'ImageModel.php';
require_once MODEL . 'CommentModel.php';
use App\core\Controller;
use App\core\View;
use App\models\ImageModel;
use App\models\CommentModel;


class Image extends Controller
{
    public function __construct()
    {
        $this->imageModel = new ImageModel();
        $this->commentModel = new CommentModel();
        $this->view = new View();
    }

    public function index()
    {            
        $this->pageData['title'] = "Страница для Задания";
        $this->pageData['image'] = $this->imageModel->vkImage();
        $this->view->render('vkimage.phtml', 'template.phtml', $this->pageData);
    }

    public function id($idN)
    {
        $id = $idN[0];
        $this->pageData['title'] = "Картинка " . $id;
        $this->pageData['image'] = $this->imageModel->getImage($id);
        $this->pageData['comment'] = $this->commentModel->getComment($id);
        $this->view->render('image.phtml', 'template.phtml', $this->pageData);        
    }

    public function delImage($idN)
    {
        $this->imageModel->delImage($idN);
    }

    public function addComment($idN)
    {
        $this->commentModel->addComment($idN);
    }

    public function delComment($idN)
    {
        $this->commentModel->delComment($idN);
    }

    public function uppComment($idN)
    {
        //Когда нибудь реализую
    }
}
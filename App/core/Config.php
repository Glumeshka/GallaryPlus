<?php

namespace App\core;

define("MAX_FILE_SIZE", 5000000);
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('UPLOAD_DIR', 'uploads');

define("ROOT", dirname(__DIR__, 2) . DIRECTORY_SEPARATOR);
define("APP", ROOT . 'App' . DIRECTORY_SEPARATOR);
define("CORE", APP . 'core' . DIRECTORY_SEPARATOR);
define("DATA", APP . 'data' . DIRECTORY_SEPARATOR);
define("MODEL", APP . 'models' . DIRECTORY_SEPARATOR);
define("VIEW", APP . 'views' . DIRECTORY_SEPARATOR);
define("CONTROLLER", APP . 'controllers' . DIRECTORY_SEPARATOR);
define("LAYOUT", VIEW . 'layout' . DIRECTORY_SEPARATOR);
define("LOGS", ROOT . 'logs' . DIRECTORY_SEPARATOR);
define('CONTROLLERS_NAMESPACE', 'App\\controllers\\');

// Роли для задания
define('ROLE_USER', 1);
define('ROLE_VKUSER', 2);

// данные с регистрированного приложения из VK
define('ID_VK', '51712911');
define('SECRET_VK', 'r1zEzAYuCJFZfoI17f1Q');
define('URL_VK', 'https://0b20-213-155-214-124.ngrok-free.app/Logon/logVK');

// require_once ROOT . '\vendor\autoload.php'; автолоадер НЕ РАБОТАЕТ все мозги мне выел... причина не установлена
require_once CORE . 'Route.php';
require_once CORE . 'Controller.php';
require_once CORE . 'Model.php'; 
require_once CORE . 'View.php';
require_once CORE . 'DB.php'; 
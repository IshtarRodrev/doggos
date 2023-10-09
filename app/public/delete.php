<?php

require_once "../common/init.php";

$db = DatabaseManager::getInstance();

if (!isset($_POST['id'])) {
    http_response_code(404);
    die();
}

$dog = Dog::findByPk($_POST['id']);

if (!$dog) {
    http_response_code(404);
    echo <<<HEREDOC
    <img src='https://i3.cpcache.com/merchandise/110_750x750_Front_Color-White.jpg?Size=L&AttributeValue=NA&c=False&region={"name":"FrontCenter","width":8,"height":8,"alignment":"MiddleCenter","orientation":0,"dpi":100,"crop_x":0,"crop_y":0,"crop_h":800,"crop_w":800,"scale":0,"template":{"id":83534939,"params":{}}}&cid=PUartJBjiF%2fyg4FdKqiggQ%3d%3d+%7c%7c+X5nqL0YJgh%2fomegMbGBl%2bg%3d%3d&ProductNo=699196288'></img>
    HEREDOC;
    die();
}

$dog->delete();

header("Location: /index.php", TRUE, 302);

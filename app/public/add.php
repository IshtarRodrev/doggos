<?php

require_once "../common/init.php";

$dog = new Dog();

if (isset($_POST['add'])) {
    $dog->setData($_POST);

    if ($dog->insert()) {
        header("Location: /index.php", TRUE, 302);
    }
}

include "../view/header.php";
include "../view/form.php";
include "../view/footer.php";

<?php

include "../common/init.php";

$dogs = Dog::findAll();

include "../view/header.php";
include "../view/index.php";
include "../view/footer.php";


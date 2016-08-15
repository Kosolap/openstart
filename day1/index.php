<?php

include 'functions.php';


if($_POST){

    getview('answer', $_POST['number']);

}

else {

    getview('quest');

}



<?php
include '../day11/services/SessionService.php';

session_start();

saveOrUpdate(session_id());


if(isset($_GET['users'])){

    echo getOnliene();

}
else include '../day11/view/main.php';
?>

<?php if($_SESSION['user'] == 'Anon'){?>
    Аноним
<?php }
else{ echo $_SESSION['user']; }?>

<a href="../day2">Главная</a>




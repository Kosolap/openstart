<ol class="pills">


    <?php
    for($i = 0; $i < count($data); $i++) {
        echo '<li><a href="../day8/?info='.$data[$i]["login"].'" class="lilink">'.$data[$i]["login"].'</a></li>';
    }
    ?>


</ol>
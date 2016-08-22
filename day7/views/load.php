<form name="upload" action="index.php" method="POST" ENCTYPE="multipart/form-data">
    <input type="file" name="userfile">
    <br/>
    <br/>
    <input type="submit" name="upload" value="Загрузить">
</form>


<?php if(isset($message)){
    ?>

    <script language="JavaScript">
        message(<?php echo $message; ?>);
    </script>

<?php }?>
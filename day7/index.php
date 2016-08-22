<?php
include '../day7/classes/functions.php';
include '../day7/classes/image.php';




if(isset($_FILES['userfile'])){


    if(preg_match('/\.(gif|jpef|swf|png|jpg|bmp|psd)$/',$_FILES['userfile']['name'])){

        $uploaddir = '../day7/uploads/'; // Relative path under webroot
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);


        $new_image = new picture($uploadfile);
        $new_image->autoimageresize(300, 500);
        $new_image->imagesave('png','../day7/uploads/big_'.$_FILES['userfile']['name']);
        $new_image->imageout();


        $new_image = new picture($uploadfile);
        $new_image->imageresize(150,150);
        $new_image->imagesave('png','../day7/uploads/small_'.$_FILES['userfile']['name']);
        $new_image->imageout();


        // Загрузка штампа и фото, для которого применяется водяной знак (называется штамп или печать)
        $stamp = imagecreatefrompng('../day7/uploads/mark.png');
        $im = imagecreatefromjpeg($uploaddir.'big_'.$_FILES['userfile']['name']);

        // Установка полей для штампа и получение высоты/ширины штампа
        $marge_right = 10;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);

        // Копирование изображения штампа на фотографию с помощью смещения края
        // и ширины фотографии для расчета позиционирования штампа.
        imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

        // Вывод и освобождение памяти
        $pos = strripos($_FILES['userfile']['name'],'.');
        $name = substr($_FILES['userfile']['name'],0,strlen($_FILES['userfile']['name'])-$pos).'.png';


        unlink($uploaddir.'big_'.$_FILES['userfile']['name']);

        imagepng($im,$uploaddir.'big_'.$name,0);
        imagedestroy($im);


        $data = array('big'=> $uploaddir.'big_'.$name,
            'small'=> $uploaddir.'small_'.$_FILES['userfile']['name']);

        getview('show',$data);


    }
    else{

        getview('load','','"Файл не является изображением"');


    }

}
else{
    getView('load');
}



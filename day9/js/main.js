var mass = [];
var ind = 0;

$(document).ready(function() {

    fillMass();
    $('#dispimg').attr('src','../day9/img/port/'+mass[ind]['name']);
    $('#name').text(mass[ind]['company']);
    $('#info').text(mass[ind]['text']);

});


function next(){

    ind++;
    $('#dispimg').attr('src','../day9/img/port/'+mass[ind]['name']);
    $('#name').text(mass[ind]['company']);
    $('#info').text(mass[ind]['text']);

}

function previos() {
    if(ind == 0) ind = mass.length - 1;
    else ind--;

    $('#dispimg').attr('src','../day9/img/port/'+mass[ind]['name']);
    $('#name').text(mass[ind]['company']);
    $('#info').text(mass[ind]['text']);
}

function Picture() {
    var name;
    var company;
    var text;
}


function fillMass() {

    mass[0] = new Picture();
    mass[0]['name'] = '1-1.png';
    mass[0]['company'] = 'GM-City';
    mass[0]['text'] = 'Интернет магазин по продаже запчастей для автомобилей Chevrolet. Главная страница.';

    mass[1] = new Picture();
    mass[1]['name'] = '1-2.png';
    mass[1]['company'] = 'GM-City';
    mass[1]['text'] = 'Интернет магазин по продаже запчастей для автомобилей Chevrolet. Каталог';

    mass[2] = new Picture();
    mass[2]['name'] = '2-1.jpg';
    mass[2]['company'] = 'SaStore';
    mass[2]['text'] = 'Доработки сайта на базе UMI.CMS';

    mass[3] = new Picture();
    mass[3]['name'] = '2-2.jpg';
    mass[3]['company'] = 'SaStore';
    mass[3]['text'] = 'Доработки сайта на базе UMI.CMS';

    mass[4] = new Picture();
    mass[4]['name'] = '3-1.jpg';
    mass[4]['company'] = 'Yonamart';
    mass[4]['text'] = 'Online-супермаркет, разработан на базе CMS 1С-Битрикс.';


    mass[5] = new Picture();
    mass[5]['name'] = '3-2.jpg';
    mass[5]['company'] = 'Yonamart';
    mass[5]['text'] = 'Online-супермаркет, разработан на базе CMS 1С-Битрикс.';

}




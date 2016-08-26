var zapr = 0;

$(document).ready(function() {
    getOnlene();
    window.setInterval(
        getOnlene, 5000);

});


function getOnlene() {
    $.ajax({
        url: '../day11/',
        data: 'users',
        success: function(data){

            $('#online').text(data);
            zapr++;
            console.log(zapr)

        },
        async: false
    });
}
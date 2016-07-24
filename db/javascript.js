/**
 * Created by RipWin10 on 15.07.2016.
 */
var backgrounds = ['weather', 'swirl', 'geometry'];

function changeBackground(bNumber){
    if (bNumber){
        $('body').css('background-image', 'url("styles/images/' + backgrounds[bNumber-1] + '.png")');
    }else{
        for (var i=0; i < backgrounds.length; i++){
            var bImage = $('body').css('background-image');
            if (bImage.includes(backgrounds[i])){
                if (i == backgrounds.length-1){
                    $('body').css('background-image', 'url("styles/images/' + backgrounds[0] + '.png")');
                    break;
                }
                $('body').css('background-image', 'url("styles/images/' + backgrounds[i+1] + '.png")');
                break;
            }
        }

    }
}

function sendText() {
    $('.chatWindow').children('span').remove();

    $.ajax({
        url: 'db/chat_ajax.php',
        type: 'post',
        success: function(response) { console.log(response); }
    });

}

function buildPage(){
    promise = $.ajax({
        type: "GET",
        url: "db/chat_ajax.php",
        cache: false
    });
    promise.done(function (data) {
        console.log(data);
        for (i=0; i<data.length; i++){
            if (i>0 && data[i].category == data[i-1].category){
                $('#pages').children().last().append('<br><a href="' + data[i].url + '" class="link">' + data[i].name + '</a>');
            } else {
                $('#pages').append('<div class="categoryElement boxshadow"><span class="heading">' + data[i].category + '</span></div>');
                $('#pages').children().last().append('<br><a href="' + data[i].url + '" class="link">' + data[i].name + '</a>');
            }
        }
        $('.categoryElement').on('click', '.linkRemove', function (evt) {
            toRemove = ($(evt.target).parent().next('a').html());
            $(evt.target).parent().next('a').remove();
            $(evt.target).parent().prev('br').remove();
            $(evt.target).parent().remove();
            console.log(toRemove);

            $('.categoryElement .linkRemove').parent().remove();

            $('#toRemove').val(toRemove);
        })
    });
    promise.fail(function () {
        console.log('A failure occurred');
    });
}

function addLinks(){
    $('#control form').toggleClass('addLinks');
    $('#addPage').remove(); $('#removePage').remove();
}

function removeLinks() {
    $('.categoryElement a').before('<span><a class="linkRemove" onclick="">X</a></span>');
    $('#addPage').remove(); $('#removePage').remove();
    $('#removeLink').toggleClass('removeLinks');
}

/* ========================================================
        Form Process
 * ========================================================*/

//On blur Form Validation events Executes only After failure of Submittion
$('#name').on('blur', function () {
    if(submit) {
        var select_name = $(this);
        var name = select_name.val();
        if (name === '') {
            if (!document.getElementById("name-message").hasChildNodes()) {
                $('#name-message').append("<p id='append_name' class='highlight'>Name cannot be blank</p>");
            }
            if (!select_name.hasClass('has_error')) {
                $(this).addClass('has_error')
            }
        }
        else {
            if (document.getElementById("name-message").hasChildNodes()) {
                $("#append_name").remove();
            }
            if (select_name.hasClass('has_error')) {
                $(this).removeClass('has_error');
            }
        }
    }
});
$('#email').on('blur', function () {
    if(submit) {
        var select_email = $(this);
        var email = select_email.val();
        if (email === '') {
            if (!document.getElementById("email-message").hasChildNodes()) {
                $('#email-message').append("<p id='append_email' class='highlight'>Email cannot be blank</p>");
            }
            if (!select_email.hasClass('has_error')) {
                $(this).addClass('has_error')
            }
        }
        else {
            if (document.getElementById("email-message").hasChildNodes()) {
                $("#append_email").remove();
            }
            if (select_email.hasClass('has_error')) {
                $(this).removeClass('has_error');
            }
        }
    }
});
$('#message').on('blur', function () {
    if(submit) {
        var select_message = $(this);
        var message = select_message.val();
        if (message === '') {
            if (!document.getElementById("text-message").hasChildNodes()) {
                $('#text-message').append("<p id='append_text' class='highlight'>Please Provide us a message.if any!</p>");
            }
            if (!select_message.hasClass('has_error')) {
                $(this).addClass('has_error')
            }
        }
        else {
            if (document.getElementById("text-message").hasChildNodes()) {
                $("#append_text").remove();
            }
            if (select_message.hasClass('has_error')) {
                $(this).removeClass('has_error');
            }
        }
    }
});

$('#sunsetContactForm').on('submit',function (e) {
    //e.preventDefault(); //Prevents form submission

    //On Submit Form Validation events
    var select_name=$('#name');
    var select_email=$('#email');
    var select_message=$('#message');
    if(!select_name.val() || !select_email.val() ||!select_message.val()) {
        var name = select_name.val();
        if (name === '') {
            if (!document.getElementById("name-message").hasChildNodes()) {
                $('#name-message').append("<p id='append_name' class='highlight'>Name cannot be blank</p>");
            }
            e.preventDefault();
            if (!select_name.hasClass('has_error')) {
                select_name.addClass('has_error')
            }
        }
        else {
            if (document.getElementById("name-message").hasChildNodes()) {
                $("#append_name").remove();
            }
            if (select_name.hasClass('has_error')) {
                select_name.removeClass('has_error');
            }
        }


        var email = select_email.val();
        if (email === '') {
            if (!document.getElementById("email-message").hasChildNodes()) {
                $('#email-message').append("<p id='append_email' class='highlight'>Email cannot be blank</p>");
            }
            e.preventDefault();
            if (!select_email.hasClass('has_error')) {
                select_email.addClass('has_error')
            }
        }
        else {
            if (document.getElementById("email-message").hasChildNodes()) {
                $("#append_email").remove();
            }
            if (select_email.hasClass('has_error')) {
                select_email.removeClass('has_error');
            }
        }

        var message = select_message.val();
        if (message === '') {
            if (!document.getElementById("text-message").hasChildNodes()) {
                $('#text-message').append("<p id='append_text' class='highlight'>Please Provide us a message.if any!</p>");
            }
            e.preventDefault();
            if (!select_message.hasClass('has_error')) {
                select_message.addClass('has_error')
            }
        }
        else {
            if (document.getElementById("text-message").hasChildNodes()) {
                $("#append_text").remove();
            }
            if (select_message.hasClass('has_error')) {
                select_message.removeClass('has_error');
            }
        }
        submit=true;
        return;     //Does not proceed if any of the fields is empty
    }

});
/**/

/**
 * Social share for posts
 */

function himmelen_facebookShare(){
    window.open( 'https://www.facebook.com/sharer/sharer.php?u='+$(this).attr('href'), "facebookWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
    return false;
}
function himmelen_googlePlusShare(){
    window.open( 'https://plus.google.com/share?url='+$(this).attr('href'), "googleplusWindow", "height=380,width=660,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );
    return false;
}
function himmelen_twitterShare(){

    var $page_title = encodeURIComponent($(this).attr('data-title'));

    window.open( 'http://twitter.com/intent/tweet?text='+$page_title +' '+$(this).attr('href'), "twitterWindow", "height=370,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" );

    return false;
}
function himmelen_pinterestShare(){
    var $sharingImg;

    $sharingImg = $(this).attr('data-image');

    var $page_title = encodeURIComponent($(this).attr('data-title'));

    window.open( 'http://pinterest.com/pin/create/button/?url='+$(this).attr('href')+'&media='+$sharingImg+'&description='+$page_title, "pinterestWindow", "height=620,width=600,resizable=0,toolbar=0,menubar=0,status=0,location=0,scrollbars=0" )
    return false;
}
if( $('a.facebook-share').length > 0 || $('a.twitter-share').length > 0 || $('a.pinterest-share').length > 0 || $('a.googleplus-share').length > 0)  {

    $('.facebook-share').on('click', himmelen_facebookShare);

    $('.twitter-share').on('click', himmelen_twitterShare);

    $('.pinterest-share').on('click', himmelen_pinterestShare);

    $('.googleplus-share').on('click', himmelen_googlePlusShare);

}
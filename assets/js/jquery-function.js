$().ready(function() {

    $('.carousel').carousel({
        interval: 5000 //changes the speed
    });

    var trigger = $('.for-ass-sidebar'),
    isClosed = false;

    trigger.click(function () {
        hamburger_cross();      
    });

    function hamburger_cross() { 
        
        if (isClosed == true) {          

            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            isClosed = false;

            $("#the-side").removeClass('col-lg-3');
            $("#the-side").addClass('col-lg-1');
            $("#the-side").removeClass('col-md-4');
            $("#the-side").addClass('col-md-1');
            $("#the-side").removeClass('col-sm-4');
            $("#the-side").addClass('col-sm-1');
            $("#the-side").removeClass('col-xs-7');
            $("#the-side").addClass('col-xs-1');

            $("#the-content").removeClass('col-lg-7');
            $("#the-content").addClass('col-lg-9');
            $("#the-content").removeClass('col-md-6');
            $("#the-content").addClass('col-md-9');
            $("#the-content").removeClass('col-sm-6');
            $("#the-content").addClass('col-sm-9');
            
            if($(window).width() < 768){
                
                $("#the-side").css("width", "8.33333%");
            }

           
        } else {                       

            trigger.removeClass('is-closed');
            trigger.addClass('is-open');
            isClosed = true;       

            $("#the-side").removeClass('col-lg-1');
            $("#the-side").addClass('col-lg-3');
            $("#the-side").removeClass('col-md-1');
            $("#the-side").addClass('col-md-4');
            $("#the-side").removeClass('col-sm-1');
            $("#the-side").addClass('col-sm-4');
            $("#the-side").removeClass('col-xs-1');
            $("#the-side").addClass('col-xs-7');

            $("#the-content").removeClass('col-lg-9');
            $("#the-content").addClass('col-lg-7');
            $("#the-content").removeClass('col-md-9');
            $("#the-content").addClass('col-md-6');
            $("#the-content").removeClass('col-sm-9');
            $("#the-content").addClass('col-sm-6');
            
            if($(window).width() < 768){
                
                $("#the-side").css("width", "80%");
            }

        }
    }

    $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled', 5000);
    });

    $('[data-toggle="transs"]').click(function () {
        $('#navss').toggleClass('toggled', 5000);
    });    

    $('[data-toggle="transs-course"]').click(function () {
        $('#course-course').toggleClass('toggled', 5000);
    });  

    $('[data-toggle="transs-discover"]').click(function () {
        $('#the-discover').toggleClass('toggled', 5000);
    });    

    $('body').on('click', '.close', unsetSess);
    $("body").on("click", ".notic-board", showNotify);
    $("body").on("click", ".enrolled", sendValue);
    $('body').on('click', '.yesnoen', unEnrollCourse);

    $("body").on("submit", "#signInForm", function(){
        
        $("#loaders").removeClass('display-none');
        $("#loaders").addClass('display-block');

        $.ajax({
            url: $(this).attr('action'),
            cache: false,
            type: "POST",
            data: $(this).serializeArray(),
            //dataType: 'json',
            success: function( resp ) {
                
                if(resp == true || resp == 'true'){

                    $("#ajaxmsg").html('Successfully Sign In');
                    $("#ajaxmsg").removeClass('error');
                    $("#ajaxmsg").addClass('green');
                }

                if(resp == false || resp == 'false'){

                    $("#ajaxmsg").html('Invalid Sign In credentials');                    
                    $("#ajaxmsg").removeClass('green');
                    $("#ajaxmsg").addClass('error');
                }

                $("#loaders").removeClass('display-block');
                $("#loaders").addClass('display-none');

                setTimeout(function(){
                    
                    $("#ajaxmsg").html('');
                    if(resp == true || resp == 'true'){
                        window.location = iedu.base_url+'/get-start';
                    }
                }, 3000);
            },
            error: function( req, status, err ) {
                
                console.log( 'something went wrong', status, err );
            }
        });

        return false;
    });

    $("body").on("submit", "#signUpForm", function(){
        
        $("#loaders").removeClass('display-none');
        $("#loaders").addClass('display-block');

        $.ajax({
            url: $(this).attr('action'),
            cache: false,
            type: "POST",
            data: $(this).serializeArray(),
            //dataType: 'json',
            success: function( resp ) { 
                
                if(resp == true || resp == 'true'){

                    $("#ajaxmsg").html('Successfully Sign Up');
                    $("#ajaxmsg").removeClass('error');
                    $("#ajaxmsg").addClass('green');
                }

                if(resp == false || resp == 'false'){

                    $("#ajaxmsg").html('Something went wrong');                    
                    $("#ajaxmsg").removeClass('green');
                    $("#ajaxmsg").addClass('error');
                }

                if(resp == 'exist'){

                    $("#ajaxmsg").html('User already registered');                    
                    $("#ajaxmsg").removeClass('green');
                    $("#ajaxmsg").addClass('error');
                }

                $("#loaders").removeClass('display-block');
                $("#loaders").addClass('display-none');

                setTimeout(function(){
                    
                    $("#ajaxmsg").html('');
                    if(resp == true || resp == 'true'){
                        window.location = iedu.base_url+'/get-start';
                    }
                }, 3000);
            },
            error: function( req, status, err ) {
                
                console.log( 'something went wrong', status, err );
            }
        });

        return false;
    });

    $("body").on("click", ".deleteNotice", function(){
        $(".notityDel").attr('id', $(this).attr('id'));
    });

    $("body").on("click", ".notityDel", function(){

        var relation_id = $(this).attr('id');

        $("#loaders").removeClass('display-none');
        $("#loaders").addClass('display-block');
        
        $.ajax({
            url: iedu.base_url+'/Home/delNotify',
            cache: false,
            type: "POST",
            data: {relation_id: relation_id},
            //dataType: 'json',
            success: function( resp ) {
                
                window.location = window.location;
            },
            error: function( req, status, err ) {
                
                console.log( 'something went wrong', status, err );
            }
        });        
    });
});

function unsetSess(){
    
    $.ajax({
        url: iedu.base_url+'/Home/unsetSess',
        cache: false,
        type: "POST",
        data: {},
        //dataType: 'json',
        success: function( resp ) {
            // nothing
        },
        error: function( req, status, err ) {
            
            console.log( 'something went wrong', status, err );
        }
    });
}

function sendValue(){

    $(".yesnoen").attr('data-value', $(this).attr('data-value'));
}

function showNotify(){
    
    var relation_id = $(this).attr('data-value'); alert(relation_id);
    $(this).removeClass('bg_clr');
    $("#span-"+relation_id).html('Read');
    $("#notifyModal h4").html($('#d-title-'+relation_id).val());
    $("#notifyModal .ndesc").html($('#d-data-'+relation_id).val());

    $.ajax({
        url: iedu.base_url+'/Home/readState',
        cache: false,
        type: "POST",
        data: {relation_id: relation_id},
        //dataType: 'json',
        success: function( resp ) {
            // nothing
        },
        error: function( req, status, err ) {
            
            console.log( 'something went wrong', status, err );
        }
    });
}

function unEnrollCourse(){

    var value = $(this).attr('name');
    var course_id = $(this).attr('data-value');

    if(value == 'yes'){
        
        $("#loaders").removeClass('display-none');
        $("#loaders").addClass('display-block');

        $.ajax({
            url: iedu.base_url+'/EnrollCourse/unroll',
            cache: false,
            type: "POST",
            data: {course_id: course_id},
            //dataType: 'json',
            success: function( resp ) {

                window.location = window.location;
            },
            error: function( req, status, err ) {
                
                console.log( 'something went wrong', status, err );
            }
        });
    } 

    if(value == 'no'){

        $("#enrollRmoveModal").removeClass("in");
        $("#enrollRmoveModal").css("display", "none");
        $(".modal-backdrop").remove();
    }
}
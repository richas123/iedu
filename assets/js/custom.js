$(document).ready(function(){

	$("#nav li").hover(function(){
            $(this).children('ul').hide();
            $(this).children('ul').slideDown('fast');
        },function () {
            $('ul', this).slideUp('fast');
        }
    );
    
    $("body").on("click", ".go-signin", function(){
        $("#signupModal").removeClass("in");
        $("#signupModal").css("display", "none");
        $("#forgetModal").removeClass("in");
        $("#forgetModal").css("display", "none");
        $(".modal-backdrop").remove();
    });

    $("body").on("click", ".go-signup, .for-pass", function(){
        $("#signinModal").removeClass("in");
        $("#signinModal").css("display", "none");
        $(".modal-backdrop").remove();
    });

    $("body").on("click", ".ion-close-circled", function(){
    	$("#notifyModal").removeClass("in");
        $("#notifyModal").css("display", "none");
    	$(".modal-backdrop").remove();
    });

	$(".dot").each(function(idx, value) { 
		console.log($(this).position());
	 	console.log($(this).outerWidth());
	});

	//var headers = ["H1","H2","H3","H4","H5","H6"];
	var headers = ["H1"];

	$(".accordion").click(function(e) {
		var target = e.target,
		name = target.nodeName.toUpperCase();

		if($.inArray(name,headers) > -1) {
			var subItem = $(target).next();

			var depth = $(subItem).parents().length;
			var allAtDepth = $(".accordion p, .accordion div").filter(function() {
				if($(this).parents().length >= depth && this !== subItem.get(0)) {
					return true; 
				}
			});			
			$(allAtDepth).slideUp("fast");

			subItem.slideToggle("fast",function() {
				$(".accordion :visible:last").css("border-radius","0 0 10px 10px");
			});
			$(target).css({"border-bottom-right-radius":"0", "border-bottom-left-radius":"0"});
		}
	});

	$('body').on('click', '#foryes', function(){shareProgress(1);});
	$('body').on('click', '#forno', function(){shareProgress(0);});
	$('body').on('click', '#cancelRate', function(){
		$("#rateCourse").removeClass('in');
		$("#rateCourse").css("display", "none");
		$(".modal-backdrop").remove();
	});

	$('body').on('submit', '#courseRate', function(){

		$("#loaders").removeClass('display-none');
		$("#loaders").addClass('display-block');
		$.ajax({
	        url: this.action,
	        cache: false,
	        type: "POST",
	        data: $(this).serializeArray(),
	        //dataType: 'json',
	        success: function( resp ) {
	        	
	        	window.location = window.location;
	        },
	        error: function( req, status, err ) {
	            
	            console.log( 'something went wrong', status, err );
	        }
	    });

	    return false;
	});

	$(".toggle").removeAttr("style");
    $(".toggle-group label").html('');

    $("body").on("click", ".ios.btn-primary", function(){
    	shareProgress(0);
    });

    $("body").on("click", ".ios.btn-default", function(){
    	shareProgress(1);
    });

    $(".collapse-pre").removeAttr("style");

    
	$(window).scroll(function() {
		if ($(document).height() - $(window).height() == $(window).scrollTop()) {
	    	
	    	if($(".pag-row .enroll").attr('data-title') != undefined){

	    		$("#loaders").removeClass('display-none');
				$("#loaders").addClass('display-block');    	

	    		var offset = $(".pag-row .enroll").attr('data-title');
	    		var url = iedu.base_url+'/Paging/Paging/'+$(".pag-row .enroll").attr('data-url'); 
			    	
		    	$.ajax({
			        url: url,
			        cache: false,
			        type: "POST",
			        data: {offset: offset},
			        //dataType: 'json',
			        success: function( resp ) {
			        	
			        	$(".pag-row").remove();
			        	$(".container-data").append(resp);
			        	$("#loaders").removeClass('display-block'); 
			        	$("#loaders").addClass('display-none');		
			        },
			        error: function( req, status, err ) {
			            
			            console.log( 'something went wrong', status, err );
			        }
			    });
	    	}

	    	if($(".my-row .enroll").attr('data-title') != undefined){

	    		$("#loaders").removeClass('display-none');
				$("#loaders").addClass('display-block');    	

	    		var offset = $(".my-row .enroll").attr('data-title');
	    		var url = iedu.base_url+'/paging/mycourse';    	
		    	$.ajax({
			        url: url,
			        cache: false,
			        type: "POST",
			        data: {offset: offset},
			        //dataType: 'json',
			        success: function( resp ) {
			        	
			        	$(".my-row").remove();
			        	$(".container-data").append(resp);
			        	$("#loaders").removeClass('display-block'); 
			        	$("#loaders").addClass('display-none');		
			        },
			        error: function( req, status, err ) {
			            
			            console.log( 'something went wrong', status, err );
			        }
			    });
	    	}

	    	if($(".search-row .enroll").attr('data-title') != undefined){

	    		$("#loaders").removeClass('display-none');
				$("#loaders").addClass('display-block');    	
				
	    		var offset = $(".search-row .enroll").attr('data-title');
		    	var value = $(".search-row .enroll").attr('data-value');
		    	var url = iedu.base_url+'/Search/Search';    	
		    	$.ajax({
			        url: url,
			        cache: false,
			        type: "POST",
			        data: {offset: offset, value: value},
			        //dataType: 'json',
			        success: function( resp ) {
			        	
			        	$(".search-row").remove();
			        	$(".container-data").append(resp);
			        	$("#loaders").removeClass('display-block'); 
			        	$("#loaders").addClass('display-none');		
			        },
			        error: function( req, status, err ) {
			            
			            console.log( 'something went wrong', status, err );
			        }
			    });
	    	}		    	
		}
	});

    var addmssg = true;
    $("body").on("click", ".personal-note", function(){
    	
    	if(addmssg == true) {
    		$(".personal-note").after('<div class="add-div"></div><textarea placeholder="Message..." id="mail-msg" name="mail-msg"></textarea>');
    		addmssg = false;
    	} else {
    		$(".add-div").remove(); $("#mail-msg").remove(); addmssg = true;
    	}    	
    });

    $('body').on('submit', '#sentMail', function(e){

		$("#loaders").removeClass('display-none');
		$("#loaders").addClass('display-block');

		if(iedu.ajax_run == true) {

			$.ajax({
		        url: this.action,
		        cache: false,
		        type: "POST",
		        data: $(this).serializeArray(),
		        //dataType: 'json',
		        success: function( resp ) {
		        	
		        	window.location = window.location;
		        	$("#loaders").removeClass('display-block'); 
	        		$("#loaders").addClass('display-none');	
		        },
		        error: function( req, status, err ) {
		            
		            //console.log( 'something went wrong', status, err );
		        }
		    });
		} else {
			$("#loaders").removeClass('display-block'); 
	        $("#loaders").addClass('display-none');	
		}

	    return false;
	});
});

function getPercent(score = 1, total = 7){
		
	var	scorePercent = (score/total) * 100;
	var widthToSet = scorePercent;
	
    $(".progress").css("width",widthToSet + "%");
    $(".score").html(scorePercent.toFixed(0) + "%"); //$(".progress").css("width",$(this).val() + "%");
}

function shareProgress(value = 1){

	$("#loaders").removeClass('display-none');
	$("#loaders").addClass('display-block');

	$.ajax({
        url: iedu.base_url+'/Home/shareProgress',
        cache: false,
        type: "POST",
        data: {value: value},
        //dataType: 'json',
        success: function( resp ) {
        	
        	window.location = window.location;
        },
        error: function( req, status, err ) {
            
            console.log( 'something went wrong', status, err );
        }
    });
}
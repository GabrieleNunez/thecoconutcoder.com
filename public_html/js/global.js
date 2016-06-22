//window ready events
$(document).ready(function(){
	setTimeout(function(){
		for(var i = 0; i < lqImages.length; i++){
			var index = i;
			var path = lqImages[index];
			$.preload(index,path);
		}
	}, 3000);
	$(document).foundation();// initalize foundation
	
	// overide our forms to submit ajax only
	$('div#content').on('submit','form', function(event) {
		event.preventDefault();
		var form = this;
		$.ajax({
			url: $(form).attr("action"),
			method: $(form).attr("method"),
			data: $(form).serializeArray(),
			dataType: "json",
			
			beforeSend: function() {
				$(form).find('input,select,button').prop("disabled", true);
				$(form).find('button[type="submit"]').startIndicator();
			},
			success: function(data) {
				$('.error').remove();
				if(data.errors && !jQuery.isEmptyObject(data.errors)) {
					$.parseErrors(data.errors);
				} else {
					var callback = $(form).data("callback") ? $(form).data("callback") : function(data) {};
					window[callback](data);
				}
			},
			error: function(data) {
				alert("An unknown error has occurred");
			},
			complete: function() {
				$(form).find('input,select,button').prop("disabled", false);
				$(form).find('button[type="submit"]').stopIndicator();
			}
			
		});
		
		return false;
	});
	
	// hook into our login form
	$('div#content').on('change','input[name="email"]', function(event) {
		$.ajax({
			url: "/accounts/check?email=" + encodeURIComponent($(this).val()),
			method: "GET",
			dataType: "json",
			success: function(data) {
				$('.error').remove();
				var login = false;
				if(data.errors && !jQuery.isEmptyObject(data.errors)) {
					if(!$('form#loginForm .join-field').hasClass('hidden')){
						$('form#loginForm .join-field').addClass('leaving');
						setTimeout(function(){
							$('form#loginForm .join-field').addClass('hidden').removeClass('leaving');
						}, 250);
						$('form#loginForm button[type="submit"]').text('Log in');
					}
					$.parseErrors(data.errors);
				} else {
					if(!data.response.accountExist) {
						if(!$('form#loginForm .join-field').hasClass('hidden')){
							$('form#loginForm .join-field').addClass('leaving');
							setTimeout(function(){
								$('form#loginForm .join-field').addClass('hidden').removeClass('leaving');
							}, 250);
						}
						$('form#loginForm .join-field').removeClass('hidden');
						$('form#loginForm .join-field').first().focus();
						$('form#loginForm button[type="submit"]').text('Sign up');
					} else {
						login = true;
						$('form#loginForm button[type="submit"]').text('Log in');
					}
				}
				
				var action = login ? '/login' : '/join';
				$('form#loginForm').attr('action', action);
			},
		});

	});
});

$.fn.startIndicator = function() {
	$(this).data("original-text", $(this).text());
	$(this).text("Please wait...");
	$(this).addClass("progress-indicator");	
}

$.fn.stopIndicator = function() {
	$(this).text($(this).data("original-text"));
	$(this).removeClass("progress-indicator");
}

$.preload = function(index, path){
	var index = index;
	var path = path;
	var image = new Image();
	image.onload  = function(){
	    var hqImage = new Image();
	    var hqPath = hqImages[index];
	    hqImage.onload = function(){
	   		var elementPath = "img[src='" + path + "']";
	   		if($(elementPath).length){
	   		 	$(elementPath).attr("src",hqPath);
	   		}
	    };
	    hqImage.src = hqPath;
	};
	image.src = path;
}


$.parseErrors = function(errors) {
	var errors = errors;
	$.each(errors, function(index, item) {
		$('input[name="' + index + '"]').after('<span class="error">' + item + '</span>');
	});
}

/////// callbacks
function loginAreaSuccess(data) {
	window.location.reload();
}
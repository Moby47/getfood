function ajaxContact(theForm) {
var $ = jQuery;
$('#loader').fadeIn();
var formData = $(theForm).serialize(),
note = $('#Note');
$.ajax({
type: "POST",
url: "contact-send.php",
data: formData,
success: function(response) {
if ( note.height() ) {			
note.fadeIn('fast', function() { $(this).hide(); });
} else {
note.hide();
}
$('#LoadingGraphic').fadeOut('fast', function() {
//$(this).remove();
if (response === 'success') {
	
	$('#formtitle').hide();
	
}
// Message Sent? Show the 'Thank You' message and hide the form
result = '';
c = '';
if (response === 'success') { 
	result = 'Your message has been sent. Thank you!';
	c = 'success';
} else {
	result = response;
	c = 'error';
}
note.removeClass('success').removeClass('error').text('');
var i = setInterval(function() {
	if ( !note.is(':visible') ) {
		note.html(result).addClass(c).slideDown('fast');
		clearInterval(i);
	}
}, 40);    
}); // end loading image fadeOut
}
});
return false;
}
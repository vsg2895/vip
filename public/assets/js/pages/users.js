// Rating System
function ratingStar(star){
	star.click(function(){
		var stars = $('.ratingW').find('li')
		// var starsInAside = $('.aside-rate-box').find('svg path');
        // starsInAside.css({'fill': '#D4D3CE'});
		stars.removeClass('on');
		var thisIndex = $(this).parents('li').index();
		for(var i=0; i <= thisIndex; i++){
			stars.eq(i).addClass('on');
        //    starsInAside.eq(i).css({'fill': '#FECE1F'});
		}
    putScoreNow(thisIndex+1);
	});
}

// Put this value
function putScoreNow(i){
  $('.scoreNow').html(i);
  $('input[name="rate"]').val(i);
}

// Call rating system
$(function(){
	if($('.ratingW').length > 0){
		ratingStar($('.ratingW li a'));
	}
});

// Write review send
$('body').on('submit', '#writeReviewForm', function(e){
    // Diabled all default events
    e.preventDefault();
    
    // Get form inputs data
    const dataString = new FormData(this);

    // Disabled request moment resend form event
    $('#sendForm').addClass('disabled');
    
    // Send data to controller
    axios.post(this.getAttribute('action'), dataString)
        .then(res => {
            if(res.data == 1){ // Request sned and get success
                // Sucees Alert
                Swal.fire( 
                    dataWriteReviewTitleSendSuccess.innerText,
                    dataWriteReviewDescriptionSendSuccess.innerText,
                    'success'
                );

                // Clear inputs value
                $('textarea[form="sendMessageForm"]').val('');

                // Active resend form button
               $('#sendForm').removeClass('disabled');
            }else{ // Something wwnt wrong
                // Warning Alert
                Swal.fire(
                    dataWriteReviewTitleSendError.innerText,
                    dataWriteReviewDescriptionSendError.innerText,
                    'warning'
                );
            }
        }).catch(res => { // Request error
            // Error Alert
            Swal.fire(
                dataWriteReviewTitleSendError.innerText,
                dataWriteReviewDescriptionSendError.innerText,
                'error'
            );
        });
});
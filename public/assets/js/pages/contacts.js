// Contacts message send
sendMessageForm.addEventListener('submit', function(e){
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
                    dataContactMessageTitleSendSuccess.innerText,
                    dataContactMessageDescriptionSendSuccess.innerText,
                    'success'
                );

                // Clear inputs value
                $('textarea[form="sendMessageForm"]').val('');

                // Active resend form button
               $('#sendForm').removeClass('disabled');
            }else{ // Something wwnt wrong
                // Warning Alert
                Swal.fire(
                    dataContactMessageTitleSendError.innerText,
                    dataContactMessageDescriptionSendError.innerText,
                    'warning'
                );
            }
        }).catch(res => { // Request error
            // Error Alert
            Swal.fire(
                dataContactMessageTitleSendError.innerText,
                dataContactMessageDescriptionSendError.innerText,
                'error'
            );
        });
});
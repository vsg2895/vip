// Filtering
$(document).on('change', '.spareInput', function(e){
    // Disabled all default events
    e.preventDefault();

    // Get this
    const self = $(this);

    // Get form inputs data
    var dataString = {};
    dataString.spare_location = $('select[name="spare_location"]').val();
    dataString.spare_model = $('select[name="spare_model"]').val();
    
    // Get url
    const url = self.parents('form').attr('action');

    // Send data to controller
    axios.post(url, dataString)
    .then(res => {
        // Push items
        $('.load-content').html(res.data);

        // Check eleemt
        if($(".load-content").length > 0){
            // Scroll to pined item
            setTimeout(function(){
                $('html, body').stop().animate({scrollTop: $(".load-content").offset().top-100});
            },500);
        }    
    }).catch(res => { // Request error
       // Error Alert
        Swal.fire({ 
            icon: 'error',
            timer: 2000,
        });
    });
});
// Pagination with ajax
$(function () {
    // Click pagination item event
    $('body').on('click', '.pagination .page-link', function (e) {
        // Disable all default functions
        e.preventDefault();

        // Get page url
        let url = $(this).attr('href');

        // Check url
        if (url.indexOf('/submit') > -1) {
            // Set url
            url = url.replace('/submit', '/paginate');
        }

        // Check last or other page selected
        if ($(this).parent('li').hasClass('last-page') || $(this).parents('li').hasClass('active')) { // Last or active page
            // Last page link click event scroll to top of posts section
            $('html, body').animate({scrollTop: $(".load-content").offset().top - 200}, 400);
        } else { // Other page
            // Push new data to url
            window.history.pushState("", "", url);

            // Call function
            content_loader(url);

            // Get current page
            let current_page = url.split('page=');

            // Remove active status and add disabled statatus all links
            $('.pagination .page-item').removeClass('active').addClass('disabled');

            // Loop from pages links
            $('.pagination .page-item a.page-page').each(function (i, obj) {
                // Get page number
                let page_number = $(this).attr('href').split('page=');

                // Check new active page data
                if (page_number[1] == current_page[1]) {
                    // Add active status
                    $(this).parents('li').addClass('active');
                }
            });
        }
    });

    // Conent loader
    function content_loader(url) {
        // Send request
        axios.get(url)
            // Success
            .then(res => {
                console.log(res.data)
                // Reintializate lazy loading
                $(function () {
                    $('.lazy').lazy({effect: "fadeIn", effectTime: 200, threshold: 0});
                });

                // Remove old posts and push new posts to load content
                $('.load-content').html(res.data);

                // Page scroll to posts section start
                $(function () {
                    // Scrolling
                    $('html, body').animate({scrollTop: $(".load-content").offset().top - 200}, 400);
                });

                // A few time break before next page click event
                setTimeout(function () {
                    // Remove disabled statuses
                    $('.pagination .page-item').removeClass('disabled');
                }, 1000);
            }).catch(res => { // Failed to load data
            // Content load error response
            alert("Failed to load data :(");
        });
    }
});

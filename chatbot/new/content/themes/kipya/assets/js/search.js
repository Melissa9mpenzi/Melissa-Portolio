jQuery(document).ready(function($) {
    function performSearch(searchQuery) {
        if (searchQuery.length > 2) { 
            $.ajax({
                url: kipya_ajax_object.ajaxurl, 
                type: 'POST',
                data: {
                    'action': 'kipya_ajax_search', // AJAX action name
                    'query': searchQuery
                },
                success: function(response) {
                    if (response.trim() !== '') {
                        $('#search-results').html(response).show();
                    } else {
                        $('#search-results').html('').hide();
                    }
                }
            });
        } else {
            $('#search-results').html('').hide();
        }
    }

    // Trigger search when typing in the search input
    $('#ajax-search').on('input', function() {
        var searchQuery = $(this).val();
        performSearch(searchQuery);
    });

    // Trigger search when the search button is clicked
    $('#search-button').on('click', function(e) {
        e.preventDefault();
        var searchQuery = $('#ajax-search').val();
        performSearch(searchQuery);
    });
});

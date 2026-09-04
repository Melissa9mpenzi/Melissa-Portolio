jQuery(document).ready(function($) {
    // Initialize lightbox for Gutenberg gallery block
    $('.wp-block-gallery a').each(function() {
        $(this).attr('data-lightbox', 'gallery'); // Set data-lightbox attribute
    });

    // Reinitialize lightbox after the gallery block is updated (for AJAX navigation)
    $(document).on('DOMNodeInserted', function(e) {
        if ($(e.target).hasClass('wp-block-gallery')) {
            $('.wp-block-gallery a').each(function() {
                $(this).attr('data-lightbox', 'gallery'); // Set data-lightbox attribute
            });
        }
    });
});

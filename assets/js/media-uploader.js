(function ($) {
    $(document).ready(function () {
        let mediaUploader;

        // Handle Media Upload
        $('.shoppable-story-media-upload').on('click', function (e) {
            e.preventDefault();

            // Open the media uploader
            mediaUploader = wp.media({
                title: 'Select Thumbnail or Video',
                button: {
                    text: 'Use this media'
                },
                multiple: false
            });

            mediaUploader.on('select', function () {
                const attachment = mediaUploader.state().get('selection').first().toJSON();

                // Update the hidden input field with the media URL
                $('#thumbnail').val(attachment.url);

                // Update the preview area
                const previewHTML = attachment.type === 'video'
                    ? `<video controls style="max-width: 100%; height: auto;"><source src="${attachment.url}" type="${attachment.mime}"></video>`
                    : `<img src="${attachment.url}" style="max-width: 100%; height: auto;" />`;
                
                $('.thumbnail-preview').html(previewHTML);

                // Show the Remove Media button
                $('.shoppable-story-media-remove').show();
            });

            mediaUploader.open();
        });

        // Handle Media Removal
        $('.shoppable-story-media-remove').on('click', function (e) {
            e.preventDefault();

            // Clear the hidden input field
            $('#thumbnail').val('');

            // Reset the preview area
            $('.thumbnail-preview').html('<p>No media uploaded yet.</p>');

            // Hide the Remove Media button
            $(this).hide();
        });
    });
})(jQuery);
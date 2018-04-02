(function($) {
    $(document).ready(function() {
        function setup_frame(button) {
            frameId = button.data('media-frame');
            targetContainer = $('#' + button.data('target-image'));
            targetInput = $('[name="' + button.data('target-name') + '"]');

            wp.media.frames[frameId] = wp.media({
                title: 'Select image',
                multiple: false,
                library: {
                    type: 'image'
                },
                button: {
                    text: 'Use selected image'
                }
            });

            wp.media.frames[frameId].on('select', function() {
                selection = wp.media.frames[frameId].state().get('selection').first();
                targetImage = targetContainer.find('img');
                targetImage.prop('src', selection.attributes.url);
                targetContainer.removeClass('hidden');
                targetInput.val(selection.attributes.id);
                button.addClass('hidden');
            });
        }

        $('.js-media-button').click(function(e) {
            e.preventDefault();
            setup_frame($(this));
            frameId = $(this).data('media-frame');
            wp.media.frames[frameId].open();
        });

        $('.js-media-remove-image').click(function(e) {
            e.preventDefault();
            targetContainer = $('#' + $(this).data('target-image'));
            targetButton = $('#' + $(this).data('target-button'));
            targetInput = $('[name="' + $(this).data('target-name') + '"]');

            targetContainer.addClass('hidden');
            targetContainer.find('img').prop('src', '#');
            targetButton.removeClass('hidden');
            targetInput.val(null);
        });
    });
    
})(jQuery);

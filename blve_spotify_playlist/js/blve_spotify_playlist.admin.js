// Using the closure to map jQuery to $.
(function ($) {
// Store our function as a property of Drupal.behaviors.
    Drupal.behaviors.playlistSelectHelperSpotify = {
        attach: function (context, settings) {
            $('#edit-field-playlist-und-0-playlist-helper').change(function() {
                $('#edit-field-playlist-und-0-playlist-id').val($(this).val());
                $('#edit-field-playlist-und-0-album-id').val("");
                $('#edit-field-playlist-und-0-album-helper').val("");
            });
            $('#edit-field-playlist-und-0-album-helper').change(function() {
                $('#edit-field-playlist-und-0-album-id').val($(this).val());
                $('#edit-field-playlist-und-0-playlist-id').val("");
                $('#edit-field-playlist-und-0-playlist-helper').val("");
            });

            $('#edit-field-playlist-und-0-playlist-id').change(function() {
                $('#edit-field-playlist-und-0-album-id').val("");
            });
            $('#edit-field-playlist-und-0-album-id').change(function() {
                $('#edit-field-playlist-und-0-playlist-id').val("");
            });

        }
    };

}(jQuery));


(function ($) {
  Drupal.behaviors.socialProfileAdmin = {
    attach: function (context) {
      // Rewrite value of the autocomplete attribute which get from jquery.ui js file.
      $('.field--name-field-profile-org-details input[id*="edit-field-profile-org-details"]',context)
        .once('socialProfileAdmin').attr('autocomplete', 'organization-title');
    }
  };
})(jQuery);

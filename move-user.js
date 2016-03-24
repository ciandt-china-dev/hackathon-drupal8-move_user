(function ($) {

  Drupal.behaviors.moveUserAdmin = {
    attach: function (context, settings) {

      var formItemReassignUser = $('.form-item-reassign-user', context);
      var cancelMethodsWrapper = $("#edit-user-cancel-method", context);

      if ($('[value=move_user_reassign]').is(':checked')){
         formItemReassignUser.appendTo(cancelMethodsWrapper).show();
      } else {
        formItemReassignUser.hide();
      }

      $(cancelMethodsWrapper).find('input').once('move-user-admin', function () {
        $(this).change(function (e) {
          if ($(e.target).val() == 'move_user_reassign') {
            formItemReassignUser.appendTo(cancelMethodsWrapper).fadeIn(200);
          } else {
            formItemReassignUser.hide();
          }
        });
      }, context);

    }
  };

})(jQuery);
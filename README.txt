This module adds a new method for cancelling user accounts. 
It is based on the user_cancel_reassign cancel method from Drupal core, 
but adds the option to select which user the content is reassigned to, 
rather than just assigning content to the anonymous user.

To use simply install and enable the module, then when an administrator (or 
user with "administer users" permission) cancels a user account they will be 
given the extra option to select which user the content is reassigned to.

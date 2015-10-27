BuddyPress-Manage-Notifications
===============================

Plugin to filter and do mass actions on BuddyPress notification list.



1 – I need to include a replacement for /members/single/notifications/notifications-loop.php. This replacement includes the dropdown filter and the checkboxes. I read about buddypress plugin dev here: http://codex.buddypress.org/plugindev/how-to-enjoy-bp-theme-compat-in-plugins/#in-the-members-profile-pages But I was totally confused by it.

2 – For the dropdown filter, I’m using bp_notifications_get_registered_components() to get a list of all possible notification components. The issue is that some of the names aren’t very pretty. Is there another function I can tap into for this?

If anyone wants to test this out, you’ll need to put the custom notifications-loop.php in your child theme until I figure out issue #1 above. This has only been tested (and not fully tested) with BuddyPress 1.9.2

Some planned changes:
1 – Ajax the filtering
2 – Add confirmation before doing bulk actions
3 – Add another bulk actions dropdown to bottom of table

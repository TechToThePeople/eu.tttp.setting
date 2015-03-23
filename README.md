This module makes it easier to configure settings in CiviCRM by:

- Showing all settings on one page
- Showing multiple domain's settings on one page
- Offering a button to revert to the default on a setting by setting basis
- Allowing various setting profiles to be loaded (so you can load a Canadian profile and revert to appropriate defaults, for example).

This module relies on the settings API in 4.3. If you wish to use it against 4.2 you should use the Fuzion github civicrm deployment.

Once installed you can use this module by going to the URL
<your_domain>/civicrm/admin/setting

*Domains*

It will default to the current domain but you can alter this by adding the param domain e.g
- /civicrm/admin/setting?domain=2       - show domain 2
- /civicrm/admin/setting?domain=2,3,4   - show domains 2, 3 and 4
- /civicrm/admin/setting?domain=all     - show all domains

*Filters*

You can add filters such as 'filters=group:address' or 'filters=group:localization' to the string (you can actually filter on anything defined by getfields)

*Profiles*

There are 4 example profiles. For example the 'ca' profile is a link on the page and offers Canadian based defaults for a few fields

Notes / to-dos
- The settings metadata is not yet complete so several defaults are empty
- We will add edit in place
- The fields which are checkboxes need to be converted to show what the arrays represent

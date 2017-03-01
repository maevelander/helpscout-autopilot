Help Scout custom app - Autopilot Integration
==============================================

This is the server component you need for your Autopilot - HelpScout integration. Issues as well as pull requests are welcome.

Current version: 1.0

Install
-------

1. Download the [zip file](https://github.com/EnigmaWeb/helpscout-autopilot/archive/master.zip) and unzip.
1. Upload the helpscout-autopilot folder to your webspace
1. Make sure you define your Help Scout secret key and Autopilot API key in helpscout-autopilot.php.
1. Edit helpscout-autopilot.php for your own Autopilot custom fields as needed

Create your HelpScout app
-------------------------

1. Go to the [HelpScout custom app interface](https://secure.helpscout.net/apps/custom/).
1. Give it an App Name and set the Content Type to Dynamic Content.
1. Set the Callback URL as the filepath to helpscout-autopilot.php
1. Enter the secret key you used in helpscout-autopilot.php above.
1. Check the mailboxes you want the app to show up in
1. Save. You can now test your app.

Changelog
=========

1.0
---

* Initial version
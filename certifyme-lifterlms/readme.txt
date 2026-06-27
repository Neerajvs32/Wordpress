=== CertifyMe for LifterLMS ===
Contributors: certifyme
Tags: lifterlms, certificate, credentials, digital credentials, certifyme
Requires at least: 5.8
Tested up to: 7.0
Stable tag: 1.0.0
Requires PHP: 7.4
Requires Plugins: lifterlms
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Auto-issue CertifyMe digital credentials when a student completes a LifterLMS course.

== Description ==

CertifyMe for LifterLMS automatically issues verifiable digital credentials (certificates, badges) via the CertifyMe platform whenever a student completes a course in LifterLMS.

**Features:**

* Automatically triggers on LifterLMS course completion
* Supports multiple CertifyMe server regions (APAC, EU2, US1, Butterfly)
* Simple settings page to configure your API token and credential template
* Built-in error logging for easy debugging

**How it works:**

1. Install and activate the plugin
2. Go to **Settings > CertifyMe** and enter your CertifyMe API token and Template ID
3. Select your CertifyMe server region
4. When a student completes a LifterLMS course, a digital credential is automatically issued to them via CertifyMe

**Requirements:**

* LifterLMS plugin (free version is sufficient)
* A CertifyMe account with a valid API token and credential template

== Installation ==

1. Upload the `certifyme-lifterlms` folder to the `/wp-content/plugins/` directory, or install via the WordPress plugin screen
2. Activate the plugin through the **Plugins** screen in WordPress
3. Navigate to **Settings > CertifyMe**
4. Enter your **API Token** and **Template ID** from your CertifyMe account
5. Choose your server region and click **Save Settings**

== Frequently Asked Questions ==

= Where do I get my API Token? =

Log in to your CertifyMe account and navigate to your account settings or developer section to find your API token.

= Where do I get my Template ID? =

In your CertifyMe account, go to your credential templates and copy the ID of the template you want to use for course completion credentials.

= Which server region should I choose? =

Choose the region closest to your users or the region where your CertifyMe account is hosted. Contact CertifyMe support if you are unsure.

= Does this work with the free version of LifterLMS? =

Yes, it hooks into the standard `lifterlms_course_completed` action which is available in the free LifterLMS plugin.

= Where are errors logged? =

Errors and events are logged to the `certifyme-for-lifterlms` folder inside your WordPress uploads directory. The log directory is protected from public access.

== External Services ==

This plugin connects to the CertifyMe platform API to issue digital credentials when a student completes a LifterLMS course.

**What is sent and when:**
When a student completes a course, the plugin sends the student's name, email address, and course details to the CertifyMe API endpoint (`api/v2/credential`) on the selected server region (APAC, EU2, US1, or Butterfly). No data is sent unless a course completion event occurs and a valid API token is configured.

**Service provider:** CertifyMe (https://www.certifyme.online)

* Terms of Service: https://www.certifyme.online/TermsAndCondition
* Privacy Policy: https://www.certifyme.online/Policy

== Screenshots ==

1. CertifyMe Settings page under Settings > CertifyMe

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release.

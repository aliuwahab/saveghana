== StrapVert ==

* By WP Strap Code, http://wpstrapcode.com/

Requires at least:	3.4.1
Tested up to:		3.7.1
Stable tag:			1.1.7

StrapVert (Vert meaning Green in French) is a clean and elegant magazine come business style WordPress theme built on a solid code base of Bootstrap and
The Underscores starter theme.

== Copyright ==
StrapVert, Copyright 2013 WPStrapCode.com
StrapVert is distributed under the terms of the GNU GPL
License:      GNU General Public License v3 or later
License URI:  http://www.gnu.org/licenses/gpl-3.0.html

StrapVert is built with the following resources: 
Underscores (_s) starter theme http://underscores.me/
Copyright: Automattic, automattic.com
Licensed under GPLv2 or later

This theme was inspired and highly influenced by Konstantin Kovshenin's Expound - To the extent
that the Featured post section is based on Expound's Featured Post code slightly modified for StrapVert use.
All credits for this goes to Konstantin

Expound can be found at: http://wordpress.org/themes/expound 
Copyright: Konstantin Kovshenin - http://kovshenin.com
Licensed under GPLv2 or later

Icon Fonts: Genericons - http://genericons.com/ 
Copyright: Automattic, automattic.com
Licensed under GPLv2 or later

== License ==
All the theme files, scripts and images are licensed under GNU General Public License.
The exceptions to this license is as follows:
* Bootstrap by Twitter and the Glyphicon set are licensed under the GPL-compatible [http://www.apache.org/licenses/LICENSE-2.0 Apache License v2.0]

Limitations:
* Currently the dropdown menu group is limited to two levels - working on extending it to more. Support added as of version 1.0.4
* Post thumbnail is not displayed on single post view. Support added as of version 1.0.4 with option to disable thumbnails.
* Blog feed and single post thumbnails have been reworked and will require thumbnails to be regenerated to take full advantage of the new settings.  

Changes Explained.

The current changes implemented as of version 1.1.0 are to accommodate the numerous request for multiple rows of the secondary feature content and in
addition requests were made for the page/post content to be hidden from view leaving just the featured content. The introduction of the template-featured.php
and home.php are in effort to meet these request while still leaving the options for displaying of content/posts in addition to featured section open.

How It All Works

Standard Setup: Create posts as normal marking at least 5 as sticky (for 2 rows or more increase this by 4 i.e. 9, 13, 17 and so on). By default 5 featured
(1 main and 4 in the secondary row) will be shown. To show more rows navigate to the Customizer screen and under the "Front Page Content Option" set the required
number of featured post keeping in mind the above equation.

If Settings > > Reading is left as default "Latest Posts" then the featured section with the selected number of posts will be shown above the Blog Feed section.
If Settings > > Reading is set to "A static page" then the content of that page will be show in place of the blog feed. Using the template-featured template will
allow for the specific content to be hidden if and when desired. Showing just the featured content on home page using the above template as a static page gives the
site a unique look while still affording the option to designate a different page for the blog feed.

If installing on a pre-existing site with content then all you have to do is revisit your most important posts that you'd
like highlighted as Featured and just check the Sticky box under the publish section and save.

It is also highly recommended that you regenerate your thumbnails using the Regenerate Thumbnail plugin By Viper007Bond
or a similar plugin for best results - any future posts marked as Sticky should be perfectly fine and the regeneration
process is not required.

Options are also afforded for setting the way feature content is displayed - Oldest first, Random or Newest first.

Any other FAQ will be added to the site in due course.

Any feature suggestions are welcome and will be considered on merit and added to the theme as and when time permits - enjoy :)

== Changelog ==

= 1.1.7 =
* Added version control for better cache busting.
* Reduced site tagline to h4
* Added option to show tagline below both Site Title and Logo - tagline hidden by default.

= 1.1.6 =
* Added option to hide Title on pages

= 1.1.5 =
* Moved option to hide top nav bar to the Navigation tab for better grouping.
* Added better styling for calender widget.
* Improved styling for tables.
* Added option to use default RSS Feed url while retaining option for custom feed url.

= 1.1.4 =
* Removed and replaced the footer showcase widget area function as it was using a function that's not allowed.

= 1.1.3 =
* Added footer showcase widget area
* Added full width support for bbPress forum

= 1.1.2 =

* Added support for top navbar with option to disable.
* Added better support for desktop menu hover and mobile menu click
* General tidy up of code and files

= 1.1.1 =

* NEW: Added option to switch sidebar to the left
* Reverted to original screenshot as new one is stretched and not focused - will add new screenshot in next revision or so.

= 1.1.0 =
* NEW: Added option to hide blog feed/page content from home page depending on what is being shown on front page i.e custom page content or blog feed.
* NEW: Added template-featured for use as a custom front page.
* NEW: Added home.php to act as blog page when on page is set to static page.
* NEW: Added option to increase the number of featured posts to create multiple secondary rows - Note: This works with odd numbers + 4 i.e. default is 5 + 4 = 9 + 4 = 13 and so on.
* Added option to hide banner on main or secondary featured content
* CSS and PHP tweaks to accommodate the above changes
* Changed screenshot to reflect changes

= 1.0.9 =
* Fixed bug for new default WordPress installs where error Not Found was being returned

= 1.0.8 =
* Added option to hide featured corner banner on featured content images
* Reworked the featured image thumbnails for better display of images on blog feed and single post view.

= 1.0.7 =
* Fixed Bug: Removed left over experimental code that was returning the warning
"Warning: rsort() expects parameter 1 to be array, null given in"

= 1.0.6 =
* Added option to show featured posts by date - latest sticky post first.

= 1.0.5 =
* Fixed bug that was preventing theme from being activated on servers with PHP version 5.2 or less

= 1.0.4 =
* Added option to set Featured Posts display as latest or random sticky post feed - default is latest.
* Added better comment styling
* Added support for multi-level dropdown menu
* Added support for thumbnails on single posts with option to disable
* Minor CSS adjustments - Changed class copyright to strapvert-copyright as it was conflicting with recapture plugin

= 1.0.3 =
* Added theme url
* Added Jetpack support for featured content
* Added Site Copyright and Scroll To Top link in footer.php
* Changed social links to open in a new window with target="_blank"
* Removed unnecessary files and related code.
* Re-styled archives.php and other minor adjustments

= 1.0.2 =
* Fixed: Featured corner marker no longer visible on posts with no featured image
* NEW: Added option to hide the entire Featured section, just the top section or just the secondary section.
* Minor CSS adjustments to accommodate the above changes.

= 1.0.1 =
* Added styling for the table elements
* Added some styling to the blockquote section
* Added a brief description/instructions on how the Featured Post section works.

= 1.0.0 =
Initial Release 

== Upgrade Notice ==

To be added if and when the need arises

== Frequently Asked Questions ==

* None Yet
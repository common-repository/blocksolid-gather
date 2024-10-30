=== Blocksolid Gather ===
Contributors: peripatus
Tags: related posts, relatedposts, related, gutenberg, block editor, blocks, gather, blocksolid, custom post type, reusable, vimeo, rumble, dailymotion
Stable tag: 1.1.9
Requires at least: 5.5
Tested up to: 6.7
Requires PHP: 5.6
Donate link: https://www.peripatus.uk/payments/
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Related Posts functionality with a custom post type, shortcode and optional Gutenberg block.

== Description ==

Blockolid Gather is a content aggregator which allows you to use a shortcode or gutenberg block to display related posts, pages, posts or custom post types in a grid.

In the Classic Editor Gather can be conjured using a simple shortcode such as:

[blocksolid_gather specificposttitle="My Post"]

If you use the Block Editor / Gutenberg our included Gather block allows you to choose your related posts via certain parameters and provides a live-preview of them within your page.

If you are using our separate Blocksolid plugin as a page builder and Gutenberg overlay the Blocksolid Gather plugin also integrates well with this.

= Blocksolid Gather Features =

* Choose max posts
* Choose first post to return
* Choose number per row
* Choose post type
* Choose specific post title
* Order by date created, last modified, alphabetical title, random, author, relevance, menu order
* Order ascending or decending
* Hide margins between columns and rows
* Pad out incomplete final rows
* Filter by categories
* Filter by tags
* Related posts
* Choose the excerpt length
* Choose the excerpt sign-off
* Choose the excerpt sign-off
* Position media top, right, left, right or no media
* Choose media size from registered sizes including registered custom sizes
* Select a default placeholder image if a post does not have media or none at all
* Show only the media in a media grid
* Show image caption
* Link media to post
* Link caption to post
* Add media zoom hover effect
* Display videos including YouTube, Vimeo, Rumble and Dailymotion using their embed links
* Display Podcasts e.g. Buzzsprout
* Optionally show date last modified, author, categories, tags under post

== Installation ==

* Install the plugin using the WordPress 'Add New plugin' functionality and activate.

* Once activated a new Gather block will be added to those available within the WordPress block editor - make sure that you are not hiding any!.

* You can then call gather via a short code like [blocksolid_gather specificposttitle="My Post"]

* Parameters include:

- max_posts						(number)
- first_post					(number)
- number_per_row				(number)
- order_by						('post_date', 'modified' 'title', 'rand', 'author', 'relevance', 'menu_order')
- ascending						(true, false)
- get_related					(true, false)
- specificposttitle				(string)
- categories					(numbers)
- tags							(numbers)
- primary_category_id			(number)
- post_type						('post', 'page', 'custom-you-have-set')
- site							(number - for multisite)
- media_position				('top, 'right', 'bottom', 'left', 'none')
- media_size					('thumbnail, 'medium', 'large', 'full', 'widescreen_thumbnail', 'widescreen_medium', 'widescreen_large', 'custom-you-have-set')
- excerpt_length				(number)
- excerpt_signoff				(string like 'read more...')
- placeholder_image_src			(src of image you want to use as a default placeholder)
- placeholder_image_id			(id of image you want to use as a default placeholder)
- show_media_only				(true, false)
- show_media_caption			(true, false)
- show_media_link				(true, false)
- media_hover					(true, false)
- show_figcaption_link			(true, false)
- hide_margins					(true, false)
- final_row_pad_empty			(true, false)
- show_date_created				(true, false)
- show_author					(true, false)
- show_categories				(true, false)
- show_tags						(true, false)


* if you use the built-in Gutenberg block editor for your website you can use the plugin's bespoke 'Gather' block to place the aggregator within your content as many times as you like in whatever arrangement.

* The Gather block gives you a live preview within the Gutenberg editor.

== Screenshots ==

1. /assets/screenshots/screenshot-1.png

Block editor showing 3 column grid of mixed posts including Podcasts, YouTube, Vimeo, Rumble and Dailymotion

2. /assets/screenshots/screenshot-2.png

Showing Post settings

3. /assets/screenshots/screenshot-3.png

Showing layout settings

4. /assets/screenshots/screenshot-4.png

Showing media settings

5. /assets/screenshots/screenshot-5.png

Set to show media only

6. /assets/screenshots/screenshot-6.png

Showing excerpt settings

7. /assets/screenshots/screenshot-7.png

As shown on a page

8. /assets/screenshots/screenshot-8.png

As shown on a page with media only

== Changelog ==

= 1.1.9 =

*Set the __nextHasNoMarginBottom prop to true for back-end controls - 14 October 2024*

= 1.1.8 =

*React code updated, bumped up to WordPress 6.5 - 18 March 2024*

= 1.1.7 =

*Removed deprecated third parameter from shortcode - 24 October 2023*

= 1.1.6 =

*Full excerpts now apply_filters - 16 October 2023*

= 1.1.5 =

*Added better support for custom post type taxonomies - 16 May 2023*

= 1.1.4 =

*Replaced deprecated function get_page_by_title() - 10 March 2023*

= 1.1.3 =

*Fixed bug with tags not showing if only one tag - 15 February 2023*

= 1.1.2 =

*Default image caption from post title - 10 November 2022*

= 1.1.1 =

*Removed limit on tags and categories - 04 April 2022*

= 1.1.0 =

*Added a div to layout - 08 March 2022*

= 1.0.9 =

*Added way to move meta above title - 28 February 2022*

= 1.0.8 =

*Layout tweaks - 24 February 2022*

= 1.0.7 =

*Fixed bug with author link - 10 February 2022*

= 1.0.6 =

*Added way to move title and meta and also to add excerpt as summary at top - 09 February 2022*

= 1.0.5 =

*Tweaked to respect specified excerpts - 03 February 2022*

= 1.0.4 =

*Added a class to indicate the chosen number per row - 02 February 2022*

= 1.0.3 =

*Optionally show date last modified, author, categories, tags under post - 28 January 2022*

= 1.0.2 =

*Added ability to choose to exclude specific categories - 18 January 2022*

= 1.0.1 =

*Release Date - 07 January 2022*

First release

== Upgrade Notice ==

= 1.0.1 =

This is the first public release to be published
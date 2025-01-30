=== Search with Google ===
Contributors: rtCamp, kiranpotphode, sh4lin
Donate link: https://rtcamp.com/
Tags: google, search, cse, custom search engine, programmable search, programmable search engine, google cse, google custom search engine, google programmable search, google programmable search engine, google search
Requires at least: 4.8
Tested up to: 6.7.1
Stable tag: 1.2.2
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Replace WordPress default search with server-side rendered Google Custom Search results.

== Description ==

This plugin will replace the WordPress default search query with server-side results from either the [Custom Search Site Restricted JSON API](https://developers.google.com/custom-search/v1/site_restricted_api) or the [Custom Search JSON API](https://developers.google.com/custom-search/v1/overview). You can make your selection within the settings > Reading > Search type. This replacement is done on the WordPress back-end, so results appear as normal within WordPress search.

= Requirements =
1. [Google API Key](https://console.developers.google.com/apis/credentials)
2. [Programmable Search engine ID](https://cse.google.com/all)


= Setup =
1. [Get Google API key](https://developers.google.com/custom-search/v1/introduction). An API key is a way to identify your client to Google.
2. [Get Programmable Search engine ID](https://cse.google.com/). In Google settings, restrict the Search engine to only search for your one site.
3. On WordPress dashboard, set API Key and Custom Search Engine ID in the plugin settings. `Dashboard > Settings > Reading > Search with Google Settings`.
4. Select the search type from Custom Search Site Restricted JSON API or Custom Search API. (Refer [Notes](#notes) section for more details)

= Notes =
1. Custom Search Site Restricted JSON API can show only 100 search results for the query.
2. A result page can have maximum of 10 results.
3. Assistance for Custom Site Restricted Search JSON API is scheduled to cease as of December 18, 2024. [Read more](https://developers.google.com/custom-search/v1/site_restricted_api). Due to this modification, we are introducing an opt-in feature that enables the use of solely the Custom Search API, as opposed to the Custom Site-restricted Search API. This will allow you to continue using the Custom Search API after December 18, 2024.

= BTW, We're Hiring! =

[Join us at rtCamp, we specialize in providing high performance enterprise WordPress solutions](https://rtcamp.com/)

== Installation ==
 
1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Follow "Setup" instructions in ReadMe to configure credentials from Google Developers Console.

== Frequently Asked Questions ==
 
= Reporting a bug 🐞 =
 
Before creating a new issue, do browse through the [existing issues](https://github.com/rtCamp/search-with-google/issues) for resolution or upcoming fixes. 

If you still need to [log an issue](https://github.com/rtCamp/search-with-google/issues/new), making sure to include as much detail as you can, including clear steps to reproduce the issue, if possible.
 
= Creating a pull request =
 
Want to contribute a new feature? Start a conversation by [logging an issue](https://github.com/rtCamp/search-with-google/issues).

Once you're ready to send a pull request, please run through the following checklist: 

1. Browse through the [existing issues](https://github.com/rtCamp/search-with-google/issues) for anything related to what you want to work on. If you don't find any related issues, open a new one.

2. Fork this repository.

3. Create a branch from `develop` for each issue you'd like to address and commit your changes.

4. Push the code changes from your local clone to your fork.

5. Open a pull request and that's it! We'll respond with feedback as soon as possible (Isn't collaboration a great thing? 😌)

6. Once your pull request has passed final code review and tests, it will be merged into `develop` and be in the pipeline for the next release. Props to you! 🎉

== Changelog ==

= 1.2.2 =
* Compatible with WordPress 6.7.1
* Updates element selectors for automated testing

= 1.1 =
* Compatible with WordPress 6.4.2
* Updated PHP code to be compatible with PHP 8.2
* Fixed WordPress coding standards issues
* Used VIP compatible code for WordPress VIP compatibility
* Added support for the Custom JSON API
* Added Deprecation notice for the Custom site-restricted JSON API

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.2.2 =
* Compatible with WordPress 6.7.1
* Updates element selectors for automated testing
 
= 1.1 =
* Compatible with WordPress 6.4.2
* Updated PHP code to be compatible with PHP 8.2
* Fixed WordPress coding standards issues
* Used VIP compatible code for WordPress VIP compatibility
* Added support for the Custom JSON API
* Added Deprecation notice for the Custom site-restricted JSON API
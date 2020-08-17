=== Google Custom Search ===
Contributors: rtCamp, kiranpotphode
Donate link: https://rtcamp.com/
Tags: google, search,
Requires at least: 4.8
Tested up to: 5.4
Stable tag: 1.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A plugin for replacing WordPress default search with Google Custom Search results.

== Description ==

This plugin will bypass the WordPress default search query which fetch results from Database. Instead it will fetch search results from [Custom Search Site Restricted JSON API](https://developers.google.com/custom-search/v1/site_restricted_api)


= Requirements =
1. [Google API Key](https://console.developers.google.com/apis/credentials)
1. [Programmable Search engine ID](https://cse.google.com/all)


= Setup =
1. Get Google API key. An API key is a way to identify your client to Google. Read more [here](https://developers.google.com/custom-search/v1/introduction).
1. Get Programmable Search engine ID. Create one [here](https://cse.google.com/). In settings restrict the Search engine to only search for your one site.
1. On WordPress dashboard, set API Key and Custom Search Engine ID in the plugin settings. `Dashboard > Settings > Reading > Google Custom Search Settings`

= Notes =
1. Custom Search Site Restricted JSON API can show only 100 search results for the query.
1. A result page can have maximum of 10 results.

== Changelog ==

= 1.0 =
* Plugin deployment.

# Google Custom Search

A plugin for replacing WordPress default search with Google Custom Search results.

**Contributors:** [rtCamp](https://github.com/rtCamp/), [Kiran Potphode](https://github.com/kiranpotphode/)

**Tags:** google, search

**Requires at least:** 4.9

**Tested up to:** 5.4

**License:** [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

**Requires PHP:** 5.4+

## Description
This plugin will bypass the WordPress default search query which fetch results from Database. Instead it will fetch search results from [Custom Search Site Restricted JSON API](https://developers.google.com/custom-search/v1/site_restricted_api)

# Requirements
- [Google API Key](https://console.developers.google.com/apis/credentials)
- [Programmable Search engine ID](https://cse.google.com/all)


# Setup
- Get Google API key. An API key is a way to identify your client to Google. Read more [here](https://developers.google.com/custom-search/v1/introduction).
- Get Programmable Search engine ID. Create one [here](https://cse.google.com/). In settings restrict the Search engine to only search for your one site.
 - On WordPress dashboard, set API Key and Custom Search Engine ID in the plugin settings. `Dashboard > Settings > Reading > Google Custom Search Settings`

# Notes
- Custom Search Site Restricted JSON API can show only 100 search results for the query.
- A result page can have maximum of 10 results.

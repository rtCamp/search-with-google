# Search with Google

Replace WordPress default search with Google Custom Search results.

**Contributors:** [rtCamp](https://github.com/rtCamp/), [Kiran Potphode](https://github.com/kiranpotphode/), [Shalin Shah](https://github.com/SH4LIN)

**Tags:** google, search, cse, custom search engine, programmable search, programmable search engine, google cse, google custom search engine, google programmable search, google programmable search engine, google search

**Requires at least:** 4.8

**Tested up to:** 6.6

**License:** [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

**Requires PHP:** 7.4

## Description
This plugin will replace the WordPress default search query with server-side results from either the [Custom Search Site Restricted JSON API](https://developers.google.com/custom-search/v1/site_restricted_api) or the [Custom Search JSON API](https://developers.google.com/custom-search/v1/overview). You can make your selection within the settings > Reading > Search type. This replacement is done on the WordPress back-end, so results appear as normal within WordPress search.

## Requirements
- [Google API Key](https://console.developers.google.com/apis/credentials)
- [Programmable Search engine ID](https://cse.google.com/all)

## Setup
- [Get Google API key](https://developers.google.com/custom-search/v1/introduction). An API key is a way to identify your client to Google.
- [Get Programmable Search engine ID](https://cse.google.com/). In settings, restrict the Search engine to only search for your one site.
- On WordPress dashboard, set API Key and Custom Search Engine ID in the plugin settings. `Dashboard > Settings > Reading > Search with Google Settings`.
- Select the search type from Custom Search Site Restricted JSON API or Custom Search API. (Refer [#Notes](#notes) section for more details)

## Notes
- Custom Search Site Restricted JSON API can show only 100 search results for the query.
- A result page can have maximum of 10 results.
- Assistance for Custom Site Restricted Search JSON API is scheduled to cease as of December 18, 2024. [Read more](https://developers.google.com/custom-search/v1/site_restricted_api). Due to this modification, we are introducing an opt-in feature that enables the use of solely the Custom Search API, as opposed to the Custom Site-restricted Search API. This will allow you to continue using the Custom Search API after December 18, 2024.
- Custom Site Search API has a daily limit of 10,000 queries per day. [Read more](https://developers.google.com/custom-search/v1/overview#pricing).

## Contribute

### Reporting a bug 🐞

Before creating a new issue, do browse through the [existing issues](https://github.com/rtCamp/search-with-google/issues) for resolution or upcoming fixes. 

If you still need to [log an issue](https://github.com/rtCamp/search-with-google/issues/new), make sure to include as much detail as you can, including clear steps to reproduce your issue, if possible.

### Creating a pull request

Want to contribute to add a new feature? Start a conversation by creating an [issue](https://github.com/rtCamp/search-with-google/issues).

Once you're ready to create pull request, please go through the following checklist: 

1. Browse through the [existing issues](https://github.com/rtCamp/search-with-google/issues) for anything related to what you want to work on. If you don't find any related issues, open a new one.

1. Fork this repository.

1. Create a branch from `develop` for each issue you'd like to address and commit your changes.

1. Push the changes in the code, from your local clone to your fork.

1. Open a pull request and that's it! We'll reach back with feedback as soon as possible (Isn't collaboration a great thing? 😌)

1. Once your pull request has passed final code review and tests, it will be merged into `develop` and be in the pipeline for the next release. Props to you! 🎉

## BTW, We're Hiring!

<a href="https://rtcamp.com/"><img src="https://rtcamp.com/wp-content/uploads/sites/2/2019/04/github-banner@2x.png" alt="Join us at rtCamp, we specialize in providing high performance enterprise WordPress solutions"></a>


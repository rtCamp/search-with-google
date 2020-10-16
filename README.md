# Search with Google

Replace WordPress default search with Google Custom Search results.

**Contributors:** [rtCamp](https://github.com/rtCamp/), [Kiran Potphode](https://github.com/kiranpotphode/)

**Tags:** google, search, cse, custom search engine, programmable search, programmable search engine, google cse, google custom search engine, google programmable search, google programmable search engine, google search

**Requires at least:** 4.9

**Tested up to:** 5.4

**License:** [GPLv2 or later](http://www.gnu.org/licenses/gpl-2.0.html)

**Requires PHP:** 5.4+

## Description
This plugin will bypass the WordPress default search query with results from [Custom Search Site Restricted JSON API](https://developers.google.com/custom-search/v1/site_restricted_api).

# Requirements
- [Google API Key](https://console.developers.google.com/apis/credentials)
- [Programmable Search engine ID](https://cse.google.com/all)

# Setup
- Get Google API key. An API key is a way to identify your client to Google. Read more [here](https://developers.google.com/custom-search/v1/introduction).
- Get Programmable Search engine ID. Create one [here](https://cse.google.com/). In settings, restrict the Search engine to only search for your one site.
 - On WordPress dashboard, set API Key and Custom Search Engine ID in the plugin settings. `Dashboard > Settings > Reading > Search with Google Settings`.

# Notes
- Custom Search Site Restricted JSON API can show only 100 search results for the query.
- A result page can have maximum of 10 results.

## Contribute

### Reporting a bug 🐞

Before creating a new issue, do browse through the [existing issues](https://github.com/rtCamp/search-with-google/issues) for resolution or upcoming fixes. 

If you still need to [log an issue](https://github.com/rtCamp/search-with-google/issues/new), making sure to include as much detail as you can, including clear steps to reproduce your issue if possible.

### Creating a pull request

Want to contribute a new feature? Start a conversation by logging an [issue](https://github.com/rtCamp/search-with-google/issues).

Once you're ready to send a pull request, please run through the following checklist: 

1. Browse through the [existing issues](https://github.com/rtCamp/search-with-google/issues) for anything related to what you want to work on. If you don't find any related issues, open a new one.

1. Fork this repository.

1. Create a branch from `develop` for each issue you'd like to address and commit your changes.

1. Push the code changes from your local clone to your fork.

1. Open a pull request and that's it! We'll with feedback as soon as possible (Isn't collaboration a great thing? 😌)

1. Once your pull request has passed final code review and tests, it will be merged into `develop` and be in the pipeline for the next release. Props to you! 🎉

# BTW, We're Hiring!

<a href="https://rtcamp.com/"><img src="https://rtcamp.com/wp-content/uploads/2019/04/github-banner@2x.png" alt="Join us at rtCamp, we specialize in providing high performance enterprise WordPress solutions"></a>


#!/usr/bin/env node
// Octokit.js
// https://github.com/octokit/core.js#readme

const { Octokit } = require("@octokit/core");

const octokit = new Octokit({
  auth: process.env.TOKEN,
});

octokit.request("POST /repos/{org}/{repo}/statuses/{sha}", {
  org: "rtCamp",
  repo: "search-with-google",
  sha: process.env.SHA ? process.env.SHA : process.env.COMMIT_SHA,
  state: "success",
  conclusion: "success",
  target_url:
    "https://www.tesults.com/results/rsp/view/results/project/42ca8cc6-bcb3-4c90-a0aa-a2e9d04ad6a7",
  description: "Successfully synced to Tesults",
  context: "E2E Test Result",
});
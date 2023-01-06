/**
 * WordPress dependencies
 */
const { test, expect } = require("@wordpress/e2e-test-utils-playwright");
const { WP_BASE_URL } = require("../e2e-test-utils-playwright/src/config");

test.describe("Validate the custom search", () => {
  test("Should able to get the result for the custom search", async ({
    admin,
    page,
  }) => {
    await admin.visitAdminPage("/");
    await page.goto(WP_BASE_URL + "/?s=migration");

    expect(page.locator(".alignwide.wp-block-query-title")).toHaveText(
      "Search results for: “migration”"
    );

    // Expect post title should not be null.
    expect(
      page.locator(
        ".is-layout-flow.is-flex-container.columns-3.alignwide.wp-block-post-template"
      )
    ).not.toBe(null);
    expect(
      page.locator('role=link[name="Migrate from any CMS to WordPress"i]')
    ).toHaveText("Migrate from any CMS to WordPress");
  });
});

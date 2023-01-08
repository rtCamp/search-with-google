/**
 * WordPress dependencies
 */
const { test, expect } = require("@wordpress/e2e-test-utils-playwright");
const { WP_BASE_URL } = require("../e2e-test-utils-playwright/src/config");

test.describe("Validate the pagination", () => {
  test("Should able to see the older posts if available", async ({
    admin,
    page,
  }) => {
    await admin.visitAdminPage("/");
    await page.goto(WP_BASE_URL + "/?s=migration");

    await page.waitForTimeout(4000);
    expect(page.locator(".alignwide.wp-block-query-title")).toHaveText(
      "Search results for: “migration”"
    );

    if ((await page.locator(".wp-block-query-pagination-next").count()) > 0) {
      await page.click(".wp-block-query-pagination-next");

      expect(page.locator(".wp-block-query-pagination-previous")).not.toBe(
        null
      );
    }
  });
});
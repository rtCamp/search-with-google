/**
 * WordPress dependencies
 */
const { test, expect } = require( "@wordpress/e2e-test-utils-playwright" );
const { WP_BASE_URL } = require( "../e2e-test-utils-playwright/src/config" );
const { commonFunction } = require( "../page/CommonFunction" )


test.describe( "Validate the pagination", () => {
  test( "Should able to see the older posts if available", async ({
    admin,
    page,
  }) => {
    await admin.visitAdminPage("/");
    const commonfunction = new commonFunction(page)
    await commonfunction.search();

    if ((await page.locator(".wp-block-query-pagination-next").count()) > 0) {
      await page.click(".wp-block-query-pagination-next");

      // Expect previous button should be present. 
      expect(page.locator(".wp-block-query-pagination-previous")).not.toBe(
        null
      );
    }
  });
});

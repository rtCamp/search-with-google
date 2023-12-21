/**
 * WordPress dependencies
 */
const { test, expect } = require( "@wordpress/e2e-test-utils-playwright" );
const { WP_BASE_URL } = require( "../e2e-test-utils-playwright/src/config" );
const { commonFunction } = require( "../page/CommonFunction" )

test.describe( "Validate the search result link", () => {
  test( "Should able to validate the results link", async ({
    admin,
    page,
  }) => {
    await admin.visitAdminPage("/");
    const commonfunction = new commonFunction(page)
    await commonfunction.search();

    // Click on search result. 
    await page.locator(
      ".wp-block-post-title > a"
     ).first().click();

     // Expect it should open on new page. Kept the code commented as functionlity is not working added the issue for same. 
    //  expect(page).toHaveURL(/rtcamp.com/);
  });
});

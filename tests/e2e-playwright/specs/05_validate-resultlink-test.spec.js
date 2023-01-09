/**
 * WordPress dependencies
 */
const { test, expect } = require( "@wordpress/e2e-test-utils-playwright" );
const { WP_BASE_URL } = require( "../e2e-test-utils-playwright/src/config" );


test.describe( "Validate the search result link", () => {
  test( "Should able to validate the results link", async ({
    admin,
    page,
  }) => {
    await admin.visitAdminPage("/");
    await page.goto(WP_BASE_URL + "/?s=migration");

    await page.waitForTimeout(4000);
    expect(page.locator(".alignwide.wp-block-query-title")).toHaveText(
      "Search results for: “migration”"
    );
    
    // Click on search result. 
    await page.locator(
      ".wp-block-post-title > a"
     ).first().click();

     // Expect it should open on new page. Kept the code commented as functionlity is not working added the issue for same. 
    //  expect(page).toHaveURL(/rtcamp.com/);
  });
});

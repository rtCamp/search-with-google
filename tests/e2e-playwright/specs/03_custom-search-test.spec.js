/**
 * WordPress dependencies
 */
const { test, expect } = require( "@wordpress/e2e-test-utils-playwright" );
const { WP_BASE_URL } = require( "../e2e-test-utils-playwright/src/config" );
const { commonFunction } = require( "../page/CommonFunction" )


test.describe( "Validate the custom search", () => {
  test( "Should able to get the result for the custom search", async ({
    admin,
    page,
  }) => {
    await admin.visitAdminPage("/");
    const commonfunction = new commonFunction(page)
    await commonfunction.search();

    // Expect post title should not be null.
    expect(
      page.locator(
        ".is-layout-flow.is-flex-container.columns-3.alignwide.wp-block-post-template"
      )
    ).not.toBe(null);

    // Expect the posts title. 
    expect(
      page.locator('role=link[name="Migrate from any CMS to WordPress"i]')
    ).toHaveText("Migrate from any CMS to WordPress");
  });
});

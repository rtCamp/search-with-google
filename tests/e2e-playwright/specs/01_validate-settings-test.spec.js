/**
 * WordPress dependencies
 */
const { test, expect } = require( "@wordpress/e2e-test-utils-playwright" );
const { selectors } = require("../utils/selectors");
const { commonFunction } = require( "../page/CommonFunction" )

test.describe( "Validate the search with google settings test", () => {
  test( "Should able to validate the settings", async ({ admin, page }) => {
    await admin.visitAdminPage("/");
    const commonfunction = new commonFunction(page)
    await commonfunction.navigateToSettings();
  });
});

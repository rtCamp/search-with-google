/**
 * WordPress dependencies
 */
const { test, expect } = require( "@wordpress/e2e-test-utils-playwright");
const { selectors } = require("../utils/selectors");
const { commonFunction } = require( "../page/CommonFunction" )

test.describe( "Add the API key and engine ID", () => {
  test( "Should able to validate the API key and engine ID.", async ({ admin, page }) => {
    await admin.visitAdminPage("/");
    const commonfunction = new commonFunction(page)
    await commonfunction.navigateToSettings();

    await commonfunction.addSetttingsKeys();

    await page.click( selectors.saveChangesButton );

    await page.waitForTimeout(6000);
    expect(page.locator( "div[id='setting-error-settings_updated'] p strong" )).toHaveText( 'Settings saved.' ) // Expect settings should be saved sucessfully. 
    
  });
});

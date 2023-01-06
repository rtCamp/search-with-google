/**
 * WordPress dependencies
 */
const { test, expect } = require("@wordpress/e2e-test-utils-playwright");

test.describe("Add the API key and engine ID", () => {
  test("Should able to validate the API key and engine ID.", async ({ admin, page }) => {
    await admin.visitAdminPage("/");

    await page.hover('role=link[name="Settings"i]'); //click on settings menu.
    await page.click('role=link[name="Reading"i]');

    await page.waitForTimeout(2000);

    await expect(
      page.locator('role=heading[name="Search with Google Settings"i]')
    ).toHaveText("Search with Google Settings");

    await page.click("input[name='gcs_api_key']", {clickCount: 3}); // Clear the input before adding the value. 
    await page.type( "input[name='gcs_api_key']", process.env.API_KEY );

    await page.click("input[name='gcs_cse_id']", {clickCount: 3}); // Clear the input before adding the value. 
    await page.type( "input[name='gcs_cse_id']", process.env.ENGINE_ID );

    await page.click( 'role=button[name="Save Changes"i]' );

    expect(page.locator( "div[id='setting-error-settings_updated'] p strong" )).toHaveText( 'Settings saved.' )
    
  });
});

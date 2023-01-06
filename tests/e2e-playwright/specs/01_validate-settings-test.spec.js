/**
 * WordPress dependencies
 */
const { test, expect } = require("@wordpress/e2e-test-utils-playwright");

test.describe("Validate the search with google settings test", () => {
  test("Should able to validate the settings", async ({ admin, page }) => {
    await admin.visitAdminPage("/");

    await page.hover('role=link[name="Settings"i]'); //click on settings menu.
    await page.click('role=link[name="Reading"i]');

    await page.waitForTimeout(2000);

    await expect(
      page.locator('role=heading[name="Search with Google Settings"i]')
    ).toHaveText("Search with Google Settings");
  });
});

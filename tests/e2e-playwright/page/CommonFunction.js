import { expect } from "@playwright/test";
import { selectors } from "../utils/selectors";
import { WP_BASE_URL} from '../e2e-test-utils-playwright/src/config'
export class commonFunction {

    constructor(page) {
        this.page = page;

    }
    // Function used to navigate to the Trust.txt settings Page. 
    async navigateToSettings(){
        await this.page.hover(selectors.settingsLink); //click on settings menu.
        await this.page.click(selectors.readingSettingsLink);
    
        await this.page.waitForTimeout(2000);
    
        await expect(
          this.page.locator(selectors.searchWithGoogleHeading)
        ).toHaveText("Search with Google Settings");

    }
    // Function used to add the keys in the settings
    async addSetttingsKeys(){
        
    await this.page.click("input[name='gcs_api_key']", {clickCount: 3}); // Clear the input before adding the value. 
    await this.page.type( "input[name='gcs_api_key']", 'AIzaSyChDe210qIAFmZdDFETyg0StBuYQEuvYsA' );

    await this.page.click("input[name='gcs_cse_id']", {clickCount: 3}); // Clear the input before adding the value. 
    await this.page.type( "input[name='gcs_cse_id']", '421ea2286366b4d38' );
    }

    // Function used to search the migration string. 
    async search(){
        await this.page.goto(WP_BASE_URL + "/?s=migration");
    
        await this.page.waitForTimeout(8000);
        expect(this.page.locator(".wp-block-query-title")).toHaveText(
          "Search results for: “migration”"
        );
    
    }

    
}
// playwright.config.js
import { defineConfig } from "@playwright/test";

export default defineConfig({
    testDir: "./tests/playwright",
    timeout: 30 * 1000,
    retries: 0,
    use: {
        headless: true,
        viewport: { width: 1280, height: 720 },
        ignoreHTTPSErrors: true,
        video: "retain-on-failure",
    },
    webServer: {
        command: "php artisan serve",
        port: 8000,
        reuseExistingServer: true,
        timeout: 120 * 1000,
    },
});

// tests/playwright/login.spec.js
import { test, expect } from "@playwright/test";

test("Laravel login & dashboard check", async ({ page }) => {
    // Akses halaman login
    await page.goto("http://localhost:8000/login");

    // Isi form login
    await page.fill('input[name="email"]', "admin@example.com");
    await page.fill('input[name="password"]', "password");

    // Klik tombol login
    await page.click('button[type="submit"]');

    // Tunggu redirect ke dashboard
    await page.waitForURL("http://localhost:8000/dashboard");

    // Pastikan ada tulisan Dashboard
    await expect(page.locator("body")).toContainText("Dashboard");
});

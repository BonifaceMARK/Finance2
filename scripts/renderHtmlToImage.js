const puppeteer = require('puppeteer');
const fs = require('fs');

async function renderHtmlToImage(htmlContent, imagePath) {
    const browser = await puppeteer.launch();
    const page = await browser.newPage();
    await page.setContent(htmlContent);
    await page.screenshot({ path: imagePath });
    await browser.close();
}

// Extract HTML content and image path from command-line arguments
const htmlContent = process.argv[2];
const imagePath = process.argv[3];

// Call the rendering function
renderHtmlToImage(htmlContent, imagePath);

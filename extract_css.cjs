const fs = require('fs');
const path = require('path');

function processDirectory(dir) {
    const files = fs.readdirSync(dir);
    for (const file of files) {
        const fullPath = path.join(dir, file);
        if (fs.statSync(fullPath).isDirectory()) {
            processDirectory(fullPath);
        } else if (fullPath.endsWith('.blade.php')) {
            processFile(fullPath);
        }
    }
}

function processFile(filePath) {
    let content = fs.readFileSync(filePath, 'utf8');
    
    // RegExp to find <style>...</style> non-greedy, allowing newlines
    const styleRegex = /<style[^>]*>([\s\S]*?)<\/style>/gi;
    let match;
    let hasChanges = false;
    
    while ((match = styleRegex.exec(content)) !== null) {
        const cssContent = match[1];
        
        // Append to app.css
        fs.appendFileSync('resources/css/app.css', `\n/* Extracted from ${path.basename(filePath)} */\n${cssContent}\n`);
        hasChanges = true;
    }
    
    if (hasChanges) {
        // Remove style blocks from the file
        content = content.replace(styleRegex, '');
        fs.writeFileSync(filePath, content, 'utf8');
        console.log(`Extracted CSS from ${filePath}`);
    }
}

// Ensure the legal-styles is appended first to preserve cascade if any
if (fs.existsSync('resources/views/partes/legal-styles.blade.php')) {
    processFile('resources/views/partes/legal-styles.blade.php');
}

processDirectory('resources/views');
console.log('CSS extraction complete!');

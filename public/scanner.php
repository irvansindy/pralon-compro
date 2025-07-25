<?php
// scanner.php
set_time_limit(0);

$root = __DIR__;
$dangerous_patterns = [
    '/eval\s*\(\s*base64_decode\s*\(/i',
    '/system\s*\(/i',
    '/exec\s*\(/i',
    '/shell_exec\s*\(/i',
    '/passthru\s*\(/i',
    '/popen\s*\(/i',
    '/proc_open\s*\(/i',
    '/assert\s*\(/i',
    '/\$_(GET|POST|REQUEST)\s*\[\s*[\'"]?(cmd|exec|code)[\'"]?\s*\]/i',
];

function scanFile($file, $patterns) {
    $contents = file_get_contents($file);
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $contents)) {
            echo "[⚠️ FOUND] $file matches pattern: $pattern\n";
            return true;
        }
    }
    return false;
}

function scanDirectory($dir, $patterns) {
    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS)
    );

    foreach ($iterator as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
            scanFile($file, $patterns);
        }
    }
}

echo "🔎 Scanning for backdoors in: $root\n";
scanDirectory($root, $dangerous_patterns);
echo "✅ Scan complete.\n";

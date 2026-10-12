<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'hbwebsite');

define('BACKUP_DIR', 'D:\\BK\\');

$date = date('Y-m-d_H-i-s');
$backup_file = BACKUP_DIR . DB_NAME . '-' . $date . '.sql';

// FIX: wrap path with quotes
$mysqldump = '"C:\xampp\mysql\bin\mysqldump.exe"';

if (!file_exists(BACKUP_DIR)) {
    mkdir(BACKUP_DIR, 0777, true);
}

$command = "$mysqldump -h " . DB_HOST . " -u " . DB_USER;

if (!empty(DB_PASS)) {
    $command .= " -p" . DB_PASS;
}

$command .= " " . DB_NAME . " > " . escapeshellarg($backup_file);

exec($command . " 2>&1", $output, $result);

if ($result === 0) {
    echo "Backup created: " . $backup_file;
} else {
    echo "Backup failed";
}

// delete old backups (7 days)
$files = glob(BACKUP_DIR . '*.sql');
$now = time();

foreach ($files as $file) {
    if (is_file($file)) {
        if ($now - filemtime($file) > 7 * 24 * 60 * 60) {
            unlink($file);
        }
    }
}
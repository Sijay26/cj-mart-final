<?php
$file = 'images/s24_ultra.jpg';
if (file_exists($file)) {
    echo "File exists! Size: " . filesize($file) . " bytes.<br>";
    echo "Permissions: " . substr(sprintf('%o', fileperms($file)), -4) . "<br>";
    echo "<img src='$file' />";
} else {
    echo "File NOT found at " . realpath($file);
    echo "<br>Current dir: " . __DIR__;
}
?>

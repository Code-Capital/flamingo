<?php

$target = realpath("storage/app/public/");   // Replace with the actual target file or directory path
$link = realpath(__DIR__)."/public/storage1";    // Replace with the desired symlink path
// echo $link;
// exit();
if (symlink($target, $link)) {
    echo "Symlink created successfully!";
} else {
    echo "Error creating symlink.";
}
// echo realpath(__DIR__);
// // echo "asd";
?>

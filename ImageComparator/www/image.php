<?php
header('Content-type: image/jpeg');

$image = urldecode($_GET['image']);

echo file_get_contents($image);
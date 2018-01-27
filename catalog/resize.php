<?php
// Very simple php image resizer script with direct URL access
// usage: https://yourdomain/resize.php?file=imagefilename&size=imagewidthinpixel
// gif/png/jpeg/jpg pictures enabled only
// This script takes an image and resizes it to the given sizes for media screens
// Resize by image width

// Configuration section
$imagedir = "images";
$cachedir = "images/cache"; // relative or absolute path

$size = $_GET['size'];
$file = $_GET['file'];

if (is_numeric($size) && (int)$size !== 0) {

  $thumbWidth = (int)$size;
  $thumbHeight = null;

  $original = $imagedir . "/" . $file;
  $targetdir = $cachedir . "/" . $thumbWidth;
  $target = $targetdir . "/" . $file;
} else {
  die('Invalid image size');
}

// Check the original file exists
if (!is_file($original)) {
  die('File doesn\'t exist');
}

// Make sure the cache directory exists
if (!is_dir($cachedir)) {
  mkdir($cachedir);
  if (!is_dir($cachedir)) {
    die('Cannot create directory');
  }
  chmod($cachedir, 0777);
}

// Make sure the directory exists
if (!is_dir($targetdir)) {
  mkdir($targetdir);
  if (!is_dir($targetdir)) {
    die('Cannot create directory');
  }
  chmod($targetdir, 0777);
}

$data = getimagesize($original);
if (!$data) {
  die("Cannot get mime type");
}

// Make sure the file doesn't exist already
if (!file_exists($target)) {

  // Make sure we have enough memory
  ini_set('memory_limit', 128*1024*1024);

  // Get the current size & file type
  $width = $data[0];
  $height = $data[1];
  $type = $data[2];

  // Load the image
  switch ($type) {
    case IMAGETYPE_GIF:
      $image = imagecreatefromgif($original);
      break;

    case IMAGETYPE_JPEG:
      $image = imagecreatefromjpeg($original);
      break;

    case IMAGETYPE_PNG:
      $image = imagecreatefrompng($original);
      break;

    default:
      die("Invalid image type (#{$type} = " . image_type_to_extension($type) . ")");
  }

  // Calculate height automatically if not given
  if ($thumbHeight === null) {
    $thumbHeight = round($height * $thumbWidth / $width);
  }

  // Ratio to resize by
  $widthProportion = $thumbWidth / $width;
  $heightProportion = $thumbHeight / $height;
  $proportion = max($widthProportion, $heightProportion);

  // Area of original image that will be used
  $origWidth = floor($thumbWidth / $proportion);
  $origHeight = floor($thumbHeight / $proportion);

  // Co-ordinates of original image to use
  $x1 = floor($width - $origWidth) / 2;
  $y1 = floor($height - $origHeight) / 2;

  // Resize the image
  $thumbImage = imagecreatetruecolor($thumbWidth, $thumbHeight);
  imagecopyresampled($thumbImage, $image, 0, 0, $x1, $y1, $thumbWidth, $thumbHeight, $origWidth, $origHeight);

  // Save the new image
  switch ($type) {
    case IMAGETYPE_GIF:
      imagegif($thumbImage, $target);
      break;

    case IMAGETYPE_JPEG:
      imagejpeg($thumbImage, $target, 90);
      break;

    case IMAGETYPE_PNG:
      imagepng($thumbImage, $target);
      break;

    default:
      throw new LogicException;
  }

  // Make sure it's writable
  chmod($target, 0666);

  // Close the files
  imagedestroy($image);
  imagedestroy($thumbImage);
}

// Send the file header
header('Content-Type: ' . $data['mime']);

// Send the file to the browser
readfile($target);
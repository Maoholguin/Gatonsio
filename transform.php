<?php
  if(isset($_FILES['image'])) {
    $image = $_FILES['image'];
    $size = min(getimagesize($image['tmp_name'])[0], getimagesize($image['tmp_name'])[1], 400);
    $newImage = imagecreatetruecolor($size, $size);
    $sourceImage = imagecreatefromstring(file_get_contents($image['tmp_name']));
    $transparent = imagecolorallocatealpha($newImage, 0, 0, 0, 127);
    imagefill($newImage, 0, 0, $transparent);
    imagecopyresampled($newImage, $sourceImage, ($size - imagesx($sourceImage)) / 2, ($size - imagesy($sourceImage)) / 2, 0, 0, imagesx($sourceImage), imagesy($sourceImage), imagesx($sourceImage), imagesy($sourceImage));
    header('Content-Type: image/jpeg');
    imagejpeg($newImage);
    imagedestroy($newImage);
    imagedestroy($sourceImage);
  }
?>

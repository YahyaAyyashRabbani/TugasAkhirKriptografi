<?php
function embedWatermark($imagePath, $outputPath, $watermarkText) {
    $image = imagecreatefromstring(file_get_contents($imagePath));
    if (!$image) {
        die("Gagal memuat gambar!");
    }

    $width = imagesx($image);
    $height = imagesy($image);
    
    $watermarkBinary = '';
    foreach (str_split($watermarkText) as $char) {
        $watermarkBinary .= str_pad(decbin(ord($char)), 8, '0', STR_PAD_LEFT);
    }
    $watermarkLength = strlen($watermarkBinary);

    $watermarkIndex = 0;
    $isWatermarkHidden = false;
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            if ($watermarkIndex >= $watermarkLength) {
                $isWatermarkHidden = true;
                break;
            }

            $rgb = imagecolorat($image, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;

            $b = ($b & 0xFE) | $watermarkBinary[$watermarkIndex];
            $watermarkIndex++;

            $newColor = imagecolorallocate($image, $r, $g, $b);
            imagesetpixel($image, $x, $y, $newColor);

            if ($watermarkIndex >= $watermarkLength) {
                $isWatermarkHidden = true;
                break;
            }
        }
        if ($isWatermarkHidden) {
            break;
        }
    }

    if (imagepng($image, $outputPath)) {
        echo "Watermark berhasil disisipkan ke dalam gambar.";
    } else {
        echo "Gagal menyisipkan watermark ke dalam gambar.";
    }

    imagedestroy($image);
}


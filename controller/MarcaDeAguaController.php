<?php
// Función para agregar texto marca de agua sobre la imagen
function addTextWatermark($src, $watermark, $save=NULL) 
{
    list($width, $height) = getimagesize($src);
    $image_color = imagecreatetruecolor($width, $height);
    $image = imagecreatefromjpeg($src);
    imagecopyresampled($image_color, $image, 0, 0, 0, 0, $width, $height, $width, $height); 
    $txtcolor = imagecolorallocate($image_color, 255, 255, 224);
    $font = dirname(__FILE__).'/Roboto-Black.ttf';
    $font_size = 50;
    imagettftext($image_color, $font_size, 0, 50, 150, $txtcolor, $font, $watermark);
    
    if ($save<>'') 
    {
        imagejpeg ($image_color, $save, 100); 
    } 
    else 
    {
	   header('Content-Type: image/jpeg');
	   imagejpeg($image_color, null, 100);
    }
    
    imagedestroy($image); 
    imagedestroy($image_color); 
}

// Función para agregar marca de agua de imagen sobre imágenes
function addImageWatermark($SourceFile, $WaterMark, $DestinationFile=NULL, $opacity) 
{
    $main_img = $SourceFile; 
    $watermark_img = $WaterMark; 
    $padding = 20; 
    $opacity = $opacity;
    // crear marca de agua
    $watermark = imagecreatefrompng($watermark_img); 
    $image = imagecreatefromjpeg($main_img); 
    
    if(!$image || !$watermark) die("Error: La imagen principal o la imagen de marca de agua no se pudo cargar!");
 
    $watermark_size = getimagesize($watermark_img);
    $watermark_width = $watermark_size[0]; 
    $watermark_height = $watermark_size[1]; 
    $image_size = getimagesize($main_img); 
    $dest_x = $image_size[0] - $watermark_width - $padding; 
    $dest_y = $image_size[1] - $watermark_height - $padding;
    imagecopymerge($image, $watermark, $dest_x, $dest_y, 0, 0, $watermark_width, $watermark_height, $opacity);
    if ($DestinationFile<>'') 
    {
	   imagejpeg($image, $DestinationFile, 100); 
    } 
    else 
    {
	   header('Content-Type: image/jpeg');
	   imagejpeg($image);
    }
    imagedestroy($image); 
    imagedestroy($watermark); 
}

?>

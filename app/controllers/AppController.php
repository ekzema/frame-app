<?php
/**
 * Created by PhpStorm.
 * User: Denis
 * Date: 13.12.2017
 * Time: 1:26
 */

namespace app\controllers;
use fw\core\base\Controller;

class AppController extends Controller
{
    protected static function imageCheck($uploadedFile, $dirPath, $newFileName)
    {
        $sourceProperties = getimagesize($uploadedFile);
        $imageType = $sourceProperties[2];
        switch ($imageType) {
            case IMAGETYPE_PNG:
                $imageSrc = imagecreatefrompng($uploadedFile);
                $tmp = self::imageResize($imageSrc, $sourceProperties);
                imagepng($tmp, $dirPath . $newFileName);
                break;
            case IMAGETYPE_JPEG:
                $imageSrc = imagecreatefromjpeg($uploadedFile);
                $tmp = self::imageResize($imageSrc, $sourceProperties);
                imagejpeg($tmp, $dirPath . $newFileName);
                break;
            case IMAGETYPE_GIF:
                $imageSrc = imagecreatefromgif($uploadedFile);
                $tmp = self::imageResize($imageSrc, $sourceProperties);
                imagegif($tmp, $dirPath . $newFileName);
                break;
            default:
                echo "Invalid Image type.";
                exit;
                break;
        }
    }

    protected static function imageResize($imageSrc,$size)
    {
        $ratio = $size[0]/$size[1];
        if( $ratio > 1) {
            $width = 150;
            $height = 150/$ratio;
        }
        else {
            $width = 150*$ratio;
            $height = 150;
        }
        $newImageLayer = imagecreatetruecolor($width,$height);
        imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$width,$height,$size[0],$size[1]);
        return $newImageLayer;
    }
}
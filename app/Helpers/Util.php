<?php 

namespace App\Helpers;

class Util {

    public static function pre(array $data, bool $die = true): void {

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        if ($die === true) {
            exit;
        }
    }

    public static function templateHtml(array $images): string {

        if (count($images) <= 0) {
            return "";
        }

        $imgTag = "";

        foreach ($images as $key => $image) {
            $imgTag .= "<img src='".self::stringImageToBase64($image)."' alt='img-{$key}' title='img-{$key}'><br>";
        }

        $stringHtml = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <style>
            * {
                margin: 0;
                padding: 0;
                width: 100%;
                height: auto;
                box-sizing: border-box;
            }
        </style>
        <body>
            '.$imgTag.'
        </body>
        </html>';

        return $stringHtml;
    }

    public static function stringImageToBase64(string $pathImage): string {

        $extensionImage = pathinfo($pathImage, PATHINFO_EXTENSION);
        $contents = file_get_contents($pathImage);
        $base64 = 'data:image/' . $extensionImage . ';base64,' . base64_encode($contents);

        return $base64;
    }
}
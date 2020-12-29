<?php 

namespace App\Helpers;

class Util {

    CONST EXTENSIONS_ALLOWED = ['jpg', 'jpeg', 'png'];

    public static function pre(array $data, bool $die = true): void {

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        if ($die === true) {
            exit;
        }
    }

    public static function templateHtml(array $images): string {

        $imgTag = "";

        if (count($images) <= 0) {
            return "";
        }

        $processed = true;
        foreach ($images as $key => $image) {

            $extensionImage = pathinfo($image, PATHINFO_EXTENSION);

            $base64 = 'data:image/' . $extensionImage . ';base64,' . base64_encode(file_get_contents($image));
            $imgTag .= "<img src='{$base64}' alt='img-{$key}' title='img-{$key}'><br>";

            if (!in_array($extensionImage, self::EXTENSIONS_ALLOWED)) {
                $processed = false;
            }
        }

        if ($processed === false) {
            return "";
        }

        $stringHtml = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <style> * { margin: 0; padding: 0; width: 100%; height: auto; box-sizing: border-box; } </style>
        <body>'.$imgTag.'</body>
        </html>';

        return $stringHtml;
    }
}
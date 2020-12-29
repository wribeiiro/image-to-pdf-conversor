<?php

namespace App\Command\Conversor;

use App\Conversor;
use Minicli\Command\CommandController;

class DefaultController extends CommandController
{
    public function handle()
    {

        $app   = $this->getApp();
        $files = $app->config->files_to_upload;
        $dir   = $app->config->path_upload;
        $maxFiles = (int) $app->config->max_files;

        if (!is_array($files)) {
            $this->getPrinter()->error("Files must be array, check your config file");
            exit;
        }

        if (count($files) > $maxFiles) {
            $this->getPrinter()->error("Qty files exced limit of {$maxFiles}, check your config file");
            exit;
        }

        if (!file_exists($dir)) {
            $this->getPrinter()->error("Directory not exists, check your config file");
            exit;
        }

        $this->getPrinter()->info("Starting Conversion...");
        $this->getPrinter()->newline();

        $conversor   = new Conversor($files, $app->config->path_upload);
        $pdfDocument = $conversor->getRenderedDocument();

        if (empty($pdfDocument)) {
            $this->getPrinter()->error("A error ocurred while trying render document");
            exit;
        }

        $this->getPrinter()->success("Conversion complete\r\nFile PDF => {$pdfDocument}");
        $this->getPrinter()->newline();
    }
}
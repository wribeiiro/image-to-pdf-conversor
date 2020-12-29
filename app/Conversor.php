<?php

namespace App;

use Dompdf\Dompdf;  
use App\Helpers\Util;

class Conversor
{   
    protected array $images = [];
    protected string $document_rendered = ""; 
    protected string $pathUpload; 
    
    protected $dompdf;

    public function __construct(array $images, string $pathUpload)
    {
        $this->images      = $images;
        $this->path_upload = $pathUpload . "/pdf/"; 
        $this->dompdf      = new Dompdf();

        $this->renderDocument();
    }

    public function renderDocument() {

        $template = Util::templateHtml($this->images);

        if (!empty($template)) {
            $this->dompdf->loadHtml(Util::templateHtml($this->images));
            $this->dompdf->setPaper('A4', 'portrait');
            $this->dompdf->render();
    
            $this->document_rendered = $this->uploadDocument($this->dompdf->output());
        }
    }

    public function uploadDocument(string $contentDocument): string {

        $filename = md5(time()) . ".pdf";
        $uploaded = "";

        if (file_put_contents($this->path_upload . $filename, $contentDocument)) {
            $uploaded = $this->path_upload . $filename;
        }
        
        return $uploaded;
    }

    public function getRenderedDocument(): string {
        return $this->document_rendered;
    }
}

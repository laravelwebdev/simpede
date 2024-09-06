<?php

namespace App\Helpers;

use PhpOffice\PhpWord\TemplateProcessor as PhpWordTemplateProcessor;

class TemplateProcessor extends PhpWordTemplateProcessor
{
    public function gettempDocumentMainPart()
    {
        return $this->tempDocumentMainPart;
    }

    public function settempDocumentMainPart($new)
    {
        return $this->tempDocumentMainPart = $new;
    }
}

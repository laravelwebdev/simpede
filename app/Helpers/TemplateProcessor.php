<?php

namespace App\Helpers;

use PhpOffice\PhpWord\TemplateProcessor as PhpWordTemplateProcessor;
use PhpOffice\PhpWord\Shared\Text;

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

    protected static function ensureUtf8Encoded($subject)
    {
        return (null !== $subject) ? Text::toUTF8($subject) : '';
    }
}

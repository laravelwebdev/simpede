<?php

namespace App\Helpers;

use PhpOffice\PhpWord\Shared\Text;
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

    protected static function ensureUtf8Encoded($subject)
    {
        return ($subject !== null) ? Text::toUTF8($subject) : '';
    }

    public function cloneRow($search, $numberOfClones): void
    {
        $search = static::ensureMacroCompleted($search);

        $tagPos = strpos($this->tempDocumentMainPart, $search);
        if (! $tagPos) {
            return;
        }

        $rowStart = $this->findRowStart($tagPos);
        $rowEnd = $this->findRowEnd($tagPos);
        $xmlRow = $this->getSlice($rowStart, $rowEnd);

        // Check if there's a cell spanning multiple rows.
        if (preg_match('#<w:vMerge w:val="restart"/>#', $xmlRow)) {
            // $extraRowStart = $rowEnd;
            $extraRowEnd = $rowEnd;
            while (true) {
                $extraRowStart = $this->findRowStart($extraRowEnd + 1);
                $extraRowEnd = $this->findRowEnd($extraRowEnd + 1);

                // If extraRowEnd is lower then 7, there was no next row found.
                if ($extraRowEnd < 7) {
                    break;
                }

                // If tmpXmlRow doesn't contain continue, this row is no longer part of the spanned row.
                $tmpXmlRow = $this->getSlice($extraRowStart, $extraRowEnd);
                if (! preg_match('#<w:vMerge/>#', $tmpXmlRow) &&
                    ! preg_match('#<w:vMerge w:val="continue"\s*/>#', $tmpXmlRow)
                ) {
                    break;
                }
                // This row was a spanned row, update $rowEnd and search for the next row.
                $rowEnd = $extraRowEnd;
            }
            $xmlRow = $this->getSlice($rowStart, $rowEnd);
        }

        $result = $this->getSlice(0, $rowStart);
        $result .= implode('', $this->indexClonedVariables($numberOfClones, $xmlRow));
        $result .= $this->getSlice($rowEnd);

        $this->tempDocumentMainPart = $result;
    }
}

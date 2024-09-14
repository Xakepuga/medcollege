<?php

namespace App\Services;

use App\Services\Contracts\iParser;

class ParserService implements iParser
{
    private string $link;

    /**
     * @param string $link
     * @return $this
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return array
     */
    public function getParseData(): array
    {
        $xml = XmlParser::load($this->link);

        return $xml->parse(['data']);
    }
}

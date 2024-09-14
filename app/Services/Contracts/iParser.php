<?php

namespace App\Services\Contracts;

interface iParser
{
    /**
     * @param string $link
     * @return self
     */
    public function setLink(string $link): self;

    /**
     * @return array
     */
    public function getParseData(): array;
}

<?php

namespace Vuer\Notes\ValueObjects;

use Vuer\Notes\ValueObjects\ValueObject;

class TextObject extends ValueObject
{
    /**
     * Nl2br.
     * @return string
     */
    public function nl2br()
    {
        return nl2br($this->getOriginal());
    }

    /**
     * Uppercase
     * @return string
     */
    public function uppercase()
    {
        return strtoupper($this->getOriginal());
    }

    /**
     * Lowercase
     * @return string
     */
    public function lowercase()
    {
        return strtolower($this->getOriginal());
    }
}

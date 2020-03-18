<?php

namespace models\requests;

interface IWebRequest
{
    public function collect() : bool;

    public function validate(bool $failIfInvalid = true) : void;

    public function isValid() : bool;
}
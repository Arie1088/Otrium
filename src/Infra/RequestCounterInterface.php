<?php

namespace App\Infra;

interface RequestCounterInterface
{
    public function increase(): int;
    public function getCurrentCount(): int;
}
<?php

namespace App\DbDumper\Compressors;

interface Compressor
{
    public function useCommand(): string;

    public function useExtension(): string;
}

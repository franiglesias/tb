<?php

declare(strict_types=1);

namespace App\Lib;


class FileStorageEngine
{
    private string $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function loadObjects(string $class): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $file = fopen($this->filePath, 'rb');
        $objects = unserialize(fgets($file), ['allowed_classes' => [$class]]);
        fclose($file);

        return $objects;
    }

    public function persistObjects(array $objects): void
    {
        $file = fopen($this->filePath, 'wb');
        fwrite($file, serialize($objects));
        fclose($file);
    }

}

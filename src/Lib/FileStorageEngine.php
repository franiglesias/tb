<?php

declare(strict_types=1);

namespace App\Lib;

class FileStorageEngine
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /** @return array<object> */
    public function loadObjects(): array
    {
        if (!file_exists($this->filePath)) {
            return [];
        }

        $file = $this->openFileForReading();

        $objects = unserialize((string)fgets($file), ['allowed_classes' => true]);
        fclose($file);

        return $objects;
    }

    /** @param array<object> $objects */
    public function persistObjects(array $objects): void
    {
        $file = $this->openFileForWriting();
        fwrite($file, serialize($objects));
        fclose($file);
    }

    /** @return resource */
    protected function openFileForReading()
    {
        $file = fopen($this->filePath, 'rb');
        if (!$file) {
            throw new \RuntimeException(sprintf('Unable to open file %s for reading', $this->filePath));
        }

        return $file;
    }

    /** @return resource */
    protected function openFileForWriting()
    {
        $file = fopen($this->filePath, 'wb');
        if (!$file) {
            throw new \RuntimeException(sprintf('Unable to open file %s for writing', $this->filePath));
        }

        return $file;
    }
}

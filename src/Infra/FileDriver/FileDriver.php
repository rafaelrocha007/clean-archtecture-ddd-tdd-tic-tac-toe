<?php


namespace App\Infra\FileDriver;


class FileDriver
{
    public function __construct(private string $path)
    {
    }

    public function write(string $content)
    {
        return file_put_contents($this->path, $content);
    }

    public function read(): string
    {
        return file_get_contents($this->path);
    }
}
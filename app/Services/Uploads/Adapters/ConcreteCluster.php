<?php

namespace App\Services\Uploads\Adapters;

abstract class ConcreteCluster
{
    /**
     * Define the file name
     * @var string|null
     */
    private string|null $fileName = null;

    /**
     * Define the file size
     * @var string|null
     */
    private string|null $fileSize = null;

    /**
     * Define the file type or mime
     * @var string|null
     */
    private string|null $fileMime = null;

    /**
     * Define the file type or mime
     * @var string|null
     */
    private string|null $fileDisk = null;

    /**
     * Define the file type or mime
     * @var string|null
     */
    private string|null $filePath = null;

    /**
     * Get the file name
     * @return string|null
     */
    protected function getFileName(): ?string
    {
        return $this->fileName;
    }

    /**
     * Set the file name
     * @param  string|null $fileName
     * @return $this
     */
    protected function setFileName(?string $fileName): static
    {
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * Get the file size
     * @return string|null
     */
    protected function getFileSize(): ?string
    {
        return $this->fileSize;
    }

    /**
     * Set the file size
     * @param  string|null $fileSize
     * @param  bool|null   $convert
     * @return $this
     */
    protected function setFileSize(?string $fileSize, ?bool $convert = true): static
    {
        $this->fileSize = $convert === false ? $fileSize : sprintf('%.2f mb', $fileSize / 1024 / 1024);
        return $this;
    }

    /**
     * Get the file type or mime
     * @return string|null
     */
    protected function getFileMime(): ?string
    {
        return $this->fileMime;
    }

    /**
     * Set the file type or mime
     * @param  string|null $fileMime
     * @return $this
     */
    protected function setFileMime(?string $fileMime): static
    {
        $this->fileMime = $fileMime;
        return $this;
    }

    /**
     * Get the file disk or driver
     * @return string|null
     */
    protected function getFileDisk(): ?string
    {
        return $this->fileDisk;
    }

    /**
     * Set the file disk or driver
     * @param  string|null $fileDisk
     * @return $this
     */
    protected function setFileDisk(?string $fileDisk): static
    {
        $this->fileDisk = $fileDisk;
        return $this;
    }

    /**
     * Get the file path
     * @return string|null
     */
    protected function getFilePath(): ?string
    {
        return $this->filePath;
    }

    /**
     * Set the file path
     * @param  string|null $filePath
     * @return $this
     */
    protected function setFilePath(?string $filePath): static
    {
        $this->filePath = $filePath;
        return $this;
    }
}

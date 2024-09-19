<?php

namespace Tests\Unit\Services;

use App\Services\Contracts\FileServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileServiceTest extends TestCase
{
    const FILE_NAME = 'image.png';
    protected FileServiceContract $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = app(FileServiceContract::class);
        Storage::fake('public');
    }

    public function test_file_upload(): void
    {
        $uploadedFile = $this->uploadedFile();
        $this->assertTrue(Storage::has($uploadedFile));
        $this->assertEquals('public', Storage::getVisibility($uploadedFile));
    }

    public function test_success_with_the_valid_file()
    {
        $folder = 'test';

        $this->assertFalse(Storage::directoryExists($folder));

        $uploadedFile = $this->uploadedFile();
        $this->assertTrue(Storage::has($uploadedFile));
        $this->assertEquals('public', Storage::getVisibility($uploadedFile));
    }

    public function test_success_with_the_valid_file_and_valid_path()
    {
        $folder = 'test';

        $this->assertFalse(Storage::directoryExists($folder));

        $uploadedFile = $this->uploadedFile(self::FILE_NAME, $folder);

        $this->assertTrue(Storage::directoryExists($folder));
        $this->assertTrue(Storage::has($uploadedFile));
        $this->assertEquals('public', Storage::getVisibility($uploadedFile));
    }

    public function test_remove_file(): void
    {
        $uploadedFile = $this->uploadedFile();
        $this->assertTrue(Storage::has($uploadedFile));

        $this->service->remove($uploadedFile);
        $this->assertFalse(Storage::has($uploadedFile));
    }

    public function test_it_returns_the_same_path_for_string_file()
    {
        $fileName = 'test/image.png';
        $uploadedFile = $this->service->upload($fileName);

        $this->assertEquals($fileName, $uploadedFile);
    }

    protected function uploadedFile(string $fileName = null, string $additionalPath = ''): string
    {
        $file = UploadedFile::fake()->image($fileName ?? self::FILE_NAME);

        return $this->service->upload($file, $additionalPath);
    }
}

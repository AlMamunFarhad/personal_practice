<?php

namespace Tests\Feature\Traits;

use App\Traits\FileManagerTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FileManagerTraitTest extends TestCase
{
    public function test_uploaded_image_is_stored_as_webp(): void
    {
        Storage::fake('public');

        $uploader = new class
        {
            use FileManagerTrait;

            public function uploadImage(UploadedFile $image): string
            {
                return $this->upload('employees/', 'webp', $image);
            }
        };

        $filename = $uploader->uploadImage(UploadedFile::fake()->image('employee.png'));
        $path = 'employees/'.$filename;

        Storage::disk('public')->assertExists($path);
        $this->assertSame('webp', pathinfo($filename, PATHINFO_EXTENSION));
        $this->assertSame(
            'image/webp',
            (new \finfo(FILEINFO_MIME_TYPE))->buffer(Storage::disk('public')->get($path))
        );
    }
}

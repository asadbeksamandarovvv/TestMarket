<?php

namespace App\Services;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

final class AttachmentService
{
    public function imageCrop(UploadedFile $file, $fileName, $path, int $width, int $height): void
    {
        $image  = Image::make($file);
        $width  = $image->width() > $width ? $width : $image->width();
        $height = $image->height() > $height ? $height : $image->height();
        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::disk('public')->put("uploads/$path" . $fileName, (string)$image->encode());
    }

    /**
     * @param array<UploadedFile> $files
     * @param MorphOne|MorphMany|MorphToMany|null $relation
     * @param string $path
     * @param string|null $identifier
     *
     * @return void
     */
    public function uploadFile(
        array $files,
        MorphOne|MorphMany|MorphToMany $relation = null,
        string $path = 'files',
        string $identifier = null
    ): array {
        $result = [];
        foreach ($files as $file) {
            $type     = $file->getClientOriginalExtension();
            $fileName = md5(time() . $file->getFilename()) . '.' . $type;
            $file->storeAs('uploads/' . $path . '/original', $fileName, ['disk' => 'public']);
            $path1024 = null;
            $path512  = null;

            if (str_starts_with($file->getMimeType(), 'image')) {
                $this->imageCrop($file, $fileName, "$path/1024/", 1024, 1024);
                $path1024 = "uploads/$path/1024/$fileName";
                $this->imageCrop($file, $fileName, "$path/512/", 512, 512);
                $path512 = "uploads/$path/512/$fileName";
            }

            $data = [
                'display_name'     => $file->getClientOriginalName(),
                'size'             => $file->getSize(),
                'path_original'    => "uploads/$path/original/$fileName",
                'path_1024'        => $path1024,
                'path_512'         => $path512,
                'type'             => $file->extension(),
                'extra_identifier' => $identifier,
            ];
            $relation->create($data);
        }

        return $result;
    }

    public function uploadImage(
        UploadedFile $file,
        string $path = 'files',
    ): array {
        $type     = $file->getClientOriginalExtension();
        $fileName = md5(time() . $file->getFilename()) . '.' . $type;
        $file->storeAs('uploads/' . $path . '/original', $fileName, ['disk' => 'public']);
        $path1024 = null;
        $path512  = null;

        if (str_starts_with($file->getMimeType(), 'image')) {
            $this->imageCrop($file, $fileName, "$path/1024/", 1024, 1024);
            $path1024 = "uploads/$path/1024/$fileName";
            $this->imageCrop($file, $fileName, "$path/512/", 512, 512);
            $path512 = "uploads/$path/512/$fileName";
        }

        return [
            'path_original' => "uploads/$path/original/$fileName",
            'path_1024'     => $path1024,
            'path_512'      => $path512,
        ];
    }

    public function destroy(array|int|Attachment|Collection $files): void
    {
        if (!$files instanceof Collection) {
            $files = Arr::wrap($files);
        }
        foreach ($files as $file) {
            $this->delete($file);
        }
    }

    public function delete(Attachment|int $attachment): void
    {
        if (!$attachment instanceof Attachment) {
            $attachment = Attachment::findOrFail($attachment);
        }
        $this->removeFile($attachment);

        Attachment::withoutEvents(function () use ($attachment) {
            $attachment->delete();
        });
    }

    public function removeFile(Attachment $model): void
    {
        @unlink(storage_path('app/public/' . $model->path_original));
        @unlink(storage_path('app/public/' . $model->path_1024));
        @unlink(storage_path('app/public/' . $model->path_512));
    }

    public function removeImage($image): void
    {
        @unlink(storage_path('app/public/' . json_decode($image)->path_original));
        @unlink(storage_path('app/public/' . json_decode($image)->path_1024));
        @unlink(storage_path('app/public/' . json_decode($image)->path_512));
    }
}

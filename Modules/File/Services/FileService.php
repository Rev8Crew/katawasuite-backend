<?php

declare(strict_types=1);

namespace Modules\File\Services;

use Modules\File\Entities\File;

class FileService implements FileServiceInterface
{
    public function delete(File $file): ?bool
    {
        if (! \Storage::disk('fileStore')->delete($file->path)) {
            throw new \RuntimeException("Can't delete file: ".$file->path);
        }

        return $file->delete();
    }
}

<?php

declare(strict_types=1);

namespace Modules\File\Services;

use Modules\File\Entities\File;

interface FileServiceInterface
{
    public function delete(File $file): ?bool;
}

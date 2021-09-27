<?php
declare (strict_types=1);

namespace App\Domain;

interface TaskTransformer
{
    public function transform(Task $task): string;
}

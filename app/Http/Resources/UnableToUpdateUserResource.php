<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnableToUpdateUserResource extends JsonResource
{
    protected \Throwable $e;

    public function __construct(\Throwable $e)
    {
        $this->e = $e;
    }

    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'message' => $this->e->getMessage(),
        ];
    }
}

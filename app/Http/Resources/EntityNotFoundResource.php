<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityNotFoundResource extends JsonResource
{
    public function __construct($resource = null)
    {
        parent::__construct($resource);
    }

    /**
     * @inheritDoc
     */
    public function toArray($request): array
    {
        return [
            'message' => __('Entity not found'),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => BookResource::collection($this->collection),
            'current_page' => $this->currentPage(),
            'total_pages' => $this->lastPage(),
            'per_page' => $this->perPage(),
            'total_records' => $this->total(),
            'status' => 'success',
            'links' => [
                'prev' => $this->previousPageUrl(),
                'next' => $this->nextPageUrl(),
            ],
        ];
    }
}

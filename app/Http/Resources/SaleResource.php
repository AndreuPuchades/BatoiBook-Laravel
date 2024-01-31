<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'libro_id' => $this->idBook,
            'usuario_id' => $this->idUser,
            'fecha' => $this->date,
            'estado' => $this->status,
        ];
    }
}

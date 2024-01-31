<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'usuario_id' => $this->user_id,
            'modulo_id' => $this->module_id,
            'editorial' => $this->publisher,
            'precio' => $this->price,
            'paginas' => $this->pages,
            'estado' => $this->status,
            'foto' => $this->photo,
            'comentarios' => $this->comments,
            'fecha_venta' => $this->soldDate,
            'admitido' => $this->admit,
        ];
    }
}

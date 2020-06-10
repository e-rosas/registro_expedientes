<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CallResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'status' => $this->status(),
            'status_n' => $this->status,
            'expediente' => $this->expediente->full_name,
            'comments' => is_null($this->comments) ? '' : $this->comments,
            'date' => $this->date->format('d-M-Y'),
            'date2' => $this->date->format('Y-m-d'),
            'next_date' => (0 == $this->status) ? $this->next_date->format('d-M-Y') : '',
            'next_date2' => (0 == $this->status) ? $this->next_date->format('Y-m-d') : '',
        ];
    }
}

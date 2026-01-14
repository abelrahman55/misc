<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $lang=request()->header('lang','ar');
        return [
            'id' => $this->id,
             'title' => $this->getTranslation('title', app()->getLocale()),
    'description' => $this->getTranslation('description', app()->getLocale()),
            'image' => asset($this->image),
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

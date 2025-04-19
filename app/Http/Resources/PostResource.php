<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'title'      => $this->title,
            'content'    => $this->content,
            'writer'     => $this->user?->name,
            'image' => [
                'path' => $this->whenLoaded('image', function () {
                    return $this->image?->path ;
                }),
            ],
            'created_at' => $this->created_at->format('F d, Y'),
            'updated_at' => optional($this->updated_at)->diffForHumans(),
        ];
    }
}

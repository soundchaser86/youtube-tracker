<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VideoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->youtube_id,
            'name' => $this->name,
            'duration' => $this->duration,
            'upload_date' => $this->upload_date,
            'views' => $this->views,
            'likes' => $this->likes,
            'dislikes' => $this->dislikes,
            'comment_count' => $this->comment_count,
        ];
    }
}

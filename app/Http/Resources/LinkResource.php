<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LinkResource extends JsonResource
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
            'user_id' => (string)$this->user_id,
            'email' => $this->when($this->private, collect(explode(',', $this->email))
                ->transform(function ($item) {
                    return trim($item);
                })->all()
            ),
            'short_path' => $this->short_path,
            'url' => $this->url,
            'private' => $this->private,
            'created_at' => $this->created_at->format('d-m-Y H:s'),
        ];
    }
}

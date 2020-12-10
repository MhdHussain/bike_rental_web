<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class PhotosResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            // work
            // 'url' =>  'http://192.168.1.25:8000/storage/' . $this->id . '/' . $this->file_name
            // home
            // 'url' =>  'http://192.168.8.149:8000/storage/' . $this->id . '/' . $this->file_name
            // prod
            'url' =>  $this->url
        ];
    }
}

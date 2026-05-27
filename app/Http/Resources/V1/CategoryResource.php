<?php

namespace App\Http\Resources\V1;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // $this - в данном случае это $category кот передаем из контроллера
            "id"=> $this->id,
            "title"=> $this->title,
            "created"=> Carbon::parse($this->created_at)->format("Y-m-d H:i:s"), // можно менять название ключа
            "updated"=> Carbon::parse($this->updated_at)->format("Y-m-d H:i:s"), // можно менять название ключа
            // или например оставить только поле id 
        ];
    }
}

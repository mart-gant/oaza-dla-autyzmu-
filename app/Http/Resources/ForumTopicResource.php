<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumTopicResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_pinned' => $this->is_pinned,
            'is_locked' => $this->is_locked,
            'views_count' => $this->views_count,
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => $this->whenLoaded('category'),
            'posts' => ForumPostResource::collection($this->whenLoaded('posts')),
            'posts_count' => $this->when(isset($this->posts_count), $this->posts_count),
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}

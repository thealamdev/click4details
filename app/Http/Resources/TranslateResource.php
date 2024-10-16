<?php

namespace App\Http\Resources;

use App\Models\Translate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TranslateResource extends JsonResource
{
    /**
     * The resource that this resource collects
     * @var string
     */
    public string $collects = Translate::class;

    /**
     * The "data" wrapper that should be applied
     * @var string|null
     */
    public static $wrap = 'translate';

    /**
     * Transform the resource into an array
     * @return array<string, mixed>
     * @noinspection PhpUndefinedFieldInspection
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'local' => $this->local
        ];
    }
}

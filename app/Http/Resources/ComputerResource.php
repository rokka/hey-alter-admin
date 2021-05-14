<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(required={"name", "photoUrls"}, @OA\Xml(name="Pet"))
 */
class ComputerResource extends JsonResource
{
    /**
     * @OA\Property(format="int64")
     * @var int
     */
    public $id;

    /**
     * @OA\Property(format="int64")
     * @var int
     */
    public $type;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

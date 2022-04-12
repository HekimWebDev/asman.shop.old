<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_type' => $this->company()->exists() ? 'company' : 'simple',
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'address' => $this->address,
            $this->mergeWhen($this->company()->exists(), new CompanyResource($this->company)),
            'orders' => OrderResource::collection($this->whenLoaded('orders'))
        ];
    }
}
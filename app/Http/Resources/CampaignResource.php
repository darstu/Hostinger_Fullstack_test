<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
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
            'campaign_name' => $this->campaign_name,
            'status' => $this->status,
            'dispatch_date' => $this->dispatch_date,
            'delivery_date' => $this->delivery_date
        ];
    }
}

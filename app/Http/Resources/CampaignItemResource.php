<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CampaignItemResource extends JsonResource
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
            'campaign_id' => $this->campaign_id,
            'gift_id' => $this->gift_id,
            'gift_item_count' => $this->gift_item_count
        ];
    }
}

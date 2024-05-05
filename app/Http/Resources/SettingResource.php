<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'logo' => $this->logo,
            'text1' => $this->text1,
            'image1' => $this->image1,
            'text2' => $this->text2,
            'image2' => $this->image2,
            'text3' => $this->text3,
            'image3' => $this->image3,
            'f_link' => $this->f_link,
            'i_link' => $this->i_link,
            't_link' => $this->t_link,
            'email' => $this->email,
            'phone' => $this->phone,
            'conditions' => $this->conditions,
            'policy' => $this->policy,
        ];
    }
}

<?php

namespace App\Http\Resources;

use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

class LoggedTimeSessionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        $session_time = '00:00 hrs';
        if ($this->sessions != null && count($this->sessions) > 0) {
            $lastdt = null;
            $hour = 0;
            $minutes = 0;
            foreach($this->sessions as $d) {
                if ($lastdt == null) {
                    $lastdt = new DateTime($d->last_active);
                } else {
                    $dt = new DateTime($d->last_active);
                    $diff_mins = abs($lastdt->getTimestamp() - $dt->getTimestamp()) / 60;
                    //$diff = $lastdt->diff($dt);
                    //$lastdt = new DateTime($d->sum_session);
                    //$hour += $diff->h;
                    $minutes = $diff_mins + $minutes;
                }
            }
            $hour = intdiv($minutes, 60);
            $minutes = ($minutes % 60);
            $session_time = $hour. ':' . $minutes . ' hrs';
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'session_time' => $session_time
        ];
    }
}

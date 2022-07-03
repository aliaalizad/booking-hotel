<?php

namespace App\Helpers\Logs;

use App\Models\Booking;
use App\Models\Log;
use App\Models\LogEvent;
use Illuminate\Database\Eloquent\Model;

class LogsService {


    private function put($loggable_type, $loggable_id, $event, array $data)
    {
        $log_event = LogEvent::whereName($event)->firstOrFail();

        $params = $log_event->parameters;

        $db_data = null;
        $i = 0;
        foreach($params as $key => $value) {
            $db_data[$value] = $data[$value];
            $i++;
        }

        $loggable = $loggable_type :: findOrFail($loggable_id);

        $loggable->logs()->create([
            'log_event_id' => $log_event->id,
            'detail' => $db_data,
        ]);
    }


    private function get($loggable_type, $loggable_id, $event)
    {
        $log_event = LogEvent::whereName($event)->firstOrFail();

        $loggable = $loggable_type :: findOrFail($loggable_id);

        $logs = $loggable->logs()->where('log_event_id', $log_event->id)->pluck('detail');

        return $logs;
    }


    public function putBooking($loggable_id, array $data)
    {
        $event = 'booking';
        $loggaable_type = 'App\Models\Booking';

        $this->put($loggaable_type, $loggable_id, $event, $data);
    }

    public function getBooking($loggable_id)
    {
        $event = 'booking';
        $loggaable_type = 'App\Models\Booking';

        return $this->get($loggaable_type, $loggable_id, $event);
    }
}
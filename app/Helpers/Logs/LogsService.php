<?php

namespace App\Helpers\Logs;

use App\Models\Log;
use App\Models\LogEvent;
use Illuminate\Database\Eloquent\Model;

class LogsService {


    public function put(Model $loggable, $event, array $detail)
    {

        if (is_numeric($event)) {
            $log_event = LogEvent::findOrFail($event);
        }
        
        if (is_string($event)) {
            $log_event= LogEvent::where('name', $event)->firstOrFail();
        }

        $params = $log_event->parameters;

        $db_detail = null;
        $i = 0;
        foreach($params as $key => $value) {
            $db_detail[$value] = $detail[$i];
            $i++;
        }

        $loggable->logs()->create([
            'log_event_id' => 1,
            'detail' => $db_detail,
        ]);
    }


    public function get(Model $loggable, $event)
    {
        if (is_numeric($event)) {
            $log_event = LogEvent::findOrFail($event);
        }
        
        if (is_string($event)) {
            $log_event= LogEvent::where('name', $event)->firstOrFail();
        }

        $loggable_type = get_class($loggable);
        $loggable_id = $loggable->id;

        $logs = Log::where([['loggable_type', $loggable_type], ['loggable_id', $loggable_id], ['log_event_id', $log_event->id] ])->get();

        return $logs;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 26/04/2019
 * Time: 14:53
 */

namespace App\Http\Services;
use App\Log;
class LogService
{
    /**
     * Add log to the database
     *
     * @param $type
     * @param $source
     */
    public function setLog($type, $source) {
        // create object
        $log = new Log();
        // set values
        $log->type = $type;
        $log->source = $source;
        // save to database
        $log->save();
    }
}
<?php

namespace App\Http\Controllers;

use App\County;
use App\Program;
use Carbon\Carbon;
use Exception;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class SystemController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * returns the elapsed time
     * @param $time
     * @return false|string
     */
    public static function elapsedTime($time) {
        return Carbon::parse($time)->diffForHumans();
    }

    /**
     * Write the system log files
     * @param array $data
     * @param string $channel
     * @param string $fileName
     * @throws Exception
     */
    public static function log(array $data, string $channel, string $fileName) {
        $file = storage_path('logs/' . $fileName . '.log');

        // finally, create a formatter
        $formatter = new JsonFormatter();

        // Create the log data
        $log = [
            'ip' => request()->getClientIp(),
            'data' => $data,
        ];
        // Create a handler
        $stream = new StreamHandler($file, Logger::INFO);
        $stream->setFormatter($formatter);

        // bind it to a logger object
        $securityLogger = new Logger($channel);
        $securityLogger->pushHandler($stream);
        $securityLogger->addInfo('info', $log);
    }

    /**
     * generate student registration
     * number
     * @return string
     * @throws Exception
     */
    public static function generateStudentReg() {
        return 'LU/' . random_int(1000, 9000) . '/' . substr(date('Y'), 2, 2);
    }

    /**
     * Fetch data here
     * @return array
     */
    public static function fetchData() {
        $counties = County::query()->inRandomOrder()->get();
        $programs = Program::query()->inRandomOrder()->get();

        return [$counties, $programs];
    }

    /**
     * Get Grades Here
     * @param float $marks
     * @return string
     */
    public static function getGrade(float $marks) {
        if ($marks >= 80 && $marks < 100) {
            return 'A';
        } elseif ($marks >= 75 && $marks < 80) {
            return 'A-';
        } elseif ($marks >= 70 && $marks < 75) {
            return 'B+';
        } elseif ($marks >= 65 && $marks < 70) {
            return 'B';
        } elseif ($marks >= 60 && $marks < 65) {
            return 'B-';
        } elseif ($marks >= 55 && $marks < 60) {
            return 'C+';
        } elseif ($marks >= 50 && $marks < 55) {
            return 'C';
        } elseif ($marks >= 45 && $marks < 50) {
            return 'C-';
        } elseif ($marks >= 40 && $marks < 45) {
            return 'D+';
        } elseif ($marks >= 35 && $marks < 40) {
            return 'D';
        } elseif ($marks >= 30 && $marks < 35) {
            return 'D-';
        } else {
            return 'E';
        }
    }
}

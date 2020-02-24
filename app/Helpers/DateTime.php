<?php

namespace App\Helpers;

class DateTime
{

    private static $monthList = [
        '01' => [
            'f' => 'January',
            's' => 'Jan'
        ],
        '02' => [
            'f' => 'February',
            's' => 'Feb'
        ],
        '03' => [
            'f' => 'March',
            's' => 'Mar'
        ],
        '04' => [
            'f' => 'April',
            's' => 'Apr'
        ],
        '05' => [
            'f' => 'May',
            's' => 'May'
        ],
        '06' => [
            'f' => 'June',
            's' => 'Jun'
        ],
        '07' => [
            'f' => 'July',
            's' => 'Jul'
        ],
        '08' => [
            'f' => 'August',
            's' => 'Aug'
        ],
        '09' => [
            'f' => 'September',
            's' => 'Sep'
        ],
        '10' => [
            'f' => 'October',
            's' => 'Oct'
        ],
        '11' => [
            'f' => 'November',
            's' => 'Nov'
        ],
        '12' => [
            'f' => 'December',
            's' => 'Dec'
        ],
    ];

    /**
     * @param $date
     * @param null $setTime
     * @param string $monthFormat
     */
    public static function setData($date, $setTime = null, $monthFormat = 'f')
    {
        $resultDate = '';

        $dateTimeArray = explode(' ', $date);
        $dateParameter = explode('-', $dateTimeArray[0]);
        $timeParameter = explode(':', $dateTimeArray[1]);

        if($monthFormat == 'f' || $monthFormat == 's') {
            $resultDate .= "$dateParameter[2] " . t(self::$monthList[$dateParameter[1]][$monthFormat]) . " $dateParameter[0]";
        }

        if($setTime) {
            $resultDate .= " $timeParameter[0]:$timeParameter[1]";
        }

        return $resultDate;
    }
}
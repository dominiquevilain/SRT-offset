<?php
function applyOffset($time, $offset)
{
    $timeParts = explode(',', $time);
    $timePartsWithoutMilliSeconds = explode(':', $timeParts[0]);
    $hoursInSeconds = $timePartsWithoutMilliSeconds[0] * 3600;
    $minutesInSeconds = $timePartsWithoutMilliSeconds[1] * 60;
    $timeInMilliSeconds = 1000 * ($hoursInSeconds + $minutesInSeconds + $timePartsWithoutMilliSeconds[2]) + $timeParts[1];
    $timeInMilliSeconds += $offset;
    $milliSeconds = $timeInMilliSeconds % 1000;
    $newTimeInSeconds = ($timeInMilliSeconds - $milliSeconds) / 1000;
    $hours = floor($newTimeInSeconds / 3600);
    $mins = floor($newTimeInSeconds / 60 % 60);
    $secs = floor($newTimeInSeconds % 60);
    return sprintf('%02d:%02d:%02d,%03d', $hours, $mins, $secs, $milliSeconds);
}

function changeTime($str)
{

    $offset = 1 * ($_POST['sign'] . $_POST['offset']);
    return applyOffset($str[1], $offset);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include("form.inc.php");
} else {
    if (
        $_SERVER['REQUEST_METHOD'] === 'POST' &&
        isset($_FILES['srt'], $_POST['sign'], $_POST['offset']) &&
        is_numeric($_POST['offset']) &&
        in_array($_POST['sign'], ['+', '-'])
    ) {


        $fileName = $_FILES['srt']['tmp_name'];
        $fileMode = "r";
        $myFile = fopen($fileName, $fileMode);

        $content = fread($myFile, filesize($fileName));

        $pattern = "|(\d\d:\d\d:\d\d\,\d\d\d)|";

        echo nl2br(preg_replace_callback($pattern, "changeTime", $content));

        fclose($myFile);
    } else {
        header('Location: index.php');
    }
}
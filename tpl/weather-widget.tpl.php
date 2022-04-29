<div>
    <h3>Today's Weather</h3>
    <hr>
    Description: <?= isset($outputObj->wx_desc) ? $outputObj->wx_desc : '' ?> <br>
    Temperature: <?= isset($outputObj->temp_f) ? round($outputObj->temp_f, 0, PHP_ROUND_HALF_UP) : '' ?>&deg; <br>
    Feels Like Temp: <?= isset($outputObj->feelslike_f) ? round($outputObj->feelslike_f, 0, PHP_ROUND_HALF_UP) : '' ?>&deg; <br>
    Humidity: <?= isset($outputObj->humid_pct) ? $outputObj->humid_pct : '' ?>%<br>
    Wind Speed: <?= isset($outputObj->windspd_mph) ? $outputObj->windspd_mph : '' ?> mph<br>
    Wind Direction: <?= isset($outputObj->winddir_compass) ? $outputObj->winddir_compass : '' ?> <br>
    Dew Point: <?= isset($outputObj->dewpoint_f) ? round($outputObj->dewpoint_f, 0, PHP_ROUND_HALF_UP) : '' ?>&deg; <br>
</div>


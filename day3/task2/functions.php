<?php
function get_saved_counter()
{
    $str_count = file_get_contents(COUNTER_FILE);
    return intval($str_count);
}

function increment_conter($previous_count)
{
    if (!isset($_SESSION["counted"])) {
        $previous_count++;
        $fp = fopen(COUNTER_FILE, "w+");
        fwrite($fp, $previous_count);
        $_SESSION["counted"] = true;
    }
}

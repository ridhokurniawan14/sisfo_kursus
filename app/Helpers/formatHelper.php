<?php

if (!function_exists('formatNoRek')) {
    function formatNoRek($noRek)
    {
        return implode('-', str_split($noRek, 4));
    }
}

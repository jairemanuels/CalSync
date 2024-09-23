<?php

if (!function_exists('tenant')) {
    function tenant()
    {
        return request()->tenant ?? null;
    }
}

if (!function_exists('modelId')) {
    function modelId(): int
    {
        // generate a random 16 digit number
        return random_int(1000000000000000, 9999999999999999);
    }
}

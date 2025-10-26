<?php

namespace App\Utils;

final class ClassName
{
    private function __construct() {}

    public static function build(...$classes): string {
        $result = [];

        foreach ($classes as $class) {
            $result = array_merge($result, $class);
        }

        return implode(' ', $result);
    }
}

<?php

namespace myapp\myFrameWork;


class Formatter
{
    public static function objectsToArray(array $objects):array
    {
        foreach($objects as &$object) {
            $object = $object->toArray();
        }

        return $objects;
    }
}


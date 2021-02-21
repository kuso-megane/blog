<?php

namespace myapp\myFrameWork;


class Formatter
{

    /**
     * [ob1, ob2] changed into  [ ['id' => 1, 'title' => 'aaa'], ['id' => 2, 'title' => 'bbb'] ] (e.g.)
     * @param array $objects array of object which has toArray() method
     */
    public static function objectsToArray(array $objects):array
    {
        foreach($objects as &$object) {
            $object = $object->toArray();
        }

        return $objects;
    }
}


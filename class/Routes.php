<?php

namespace homeOfPirates\Classes;

class Routes
{
public $routes = [
'Home' => '/',
'Projects' => '/projects',
    // Add more routes here
];

    function createURL($key = '/')
    {
        /**
         * Zugriff auf die Sammlung
         **/
        global $meineURLS;
        /**
         * prüfen ob der Schlüssel existiert
         **/
        if (isset($meineURLS[$key])) {
            /**
             * Wenn vorhanden, das rewrite zurückgeben
             **/
            if (isset($meineURLS[$key]['rewrite'])){
                return $meineURLS[$key]['rewrite'];
            }
            return $key;
        }
        /**
         * Standardmässig nur den Schlüssel zurückgeben
         * wer will kann bei nicht vorhandenen URL's natürlich
         * auch zb error/404 zurückgeben, aber auf ne Fehlerseite
         * verlinken ist wahrscheinlich sinnfrei
         **/
        return $key;

    }
}
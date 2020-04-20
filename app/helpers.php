<?php
    function setActive($routes)
    {
        foreach ($routes as $routeName) {
            if (request()->routeIs($routeName)) {
                return 'active';
            }
        }
		return '';
    }

    function setOpen($routes)
    {
        foreach ($routes as $routeName) {
            if (request()->routeIs($routeName)) {
                return 'open';
            }
        }
        return '';
    }

    function format_chilean($numero)
    {
        $numero = (string) $numero;
        $puntos = floor((strlen($numero) - 1) / 3);
        $tmp = "";
        $pos = 1;
        for ($i = strlen($numero) - 1; $i >= 0; $i--) {
            $tmp = $tmp . substr($numero, $i, 1);
            if ($pos % 3 == 0 && $pos != strlen($numero))
                $tmp = $tmp . ".";
            $pos = $pos + 1;
        }
        $formateado = "$ " . strrev($tmp);
        return $formateado;
    }

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

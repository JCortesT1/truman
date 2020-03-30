<?php

namespace App\Repositories\Percents;

interface PercentsInterface
{
    public function getPercents();
    public function getPaginated();
    public function store($request);
    public function update($request, $percent);
    public function destroy($percent);
}

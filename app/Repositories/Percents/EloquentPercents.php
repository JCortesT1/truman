<?php

namespace App\Repositories\Percents;

use App\Percent;

class EloquentPercents implements PercentsInterface
{
    public function getPercents()
    {
        return Percent::all();
    }

    public function getPaginated()
    {
        return Percent::paginate(5);
    }

    public function store($request)
    {
        Percent::create($request->validated());
    }

    public function update($request, $percent)
    {
        $percent->update($request->validated());
    }

    public function destroy($percent)
    {
        $percent->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePercentRequest;
use App\Http\Requests\UpdatePercentRequest;
use App\Percent;
use App\Repositories\Percents\PercentsInterface;
use Illuminate\Http\Request;

class PercentController extends Controller
{
    protected $percents;

    function __construct(PercentsInterface $percents)
    {
        $this->percents = $percents;
        $this->middleware('auth');
        $this->middleware('roles:Administrador');
    }

    public function getPercents()
    {
        return $this->percents->getPercents();;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $percents = $this->percents->getPaginated();

        return view('percents.index', compact('percents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('percents.create', [
            'percent' => new Percent
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request\CreatePercentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePercentRequest $request)
    {
        $this->percents->store($request);

        return redirect()->route('percents.index')->with('status', 'El porcentaje fue registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Percent  $percent
     * @return \Illuminate\Http\Response
     */
    public function show(Percent $percent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Percent  $percent
     * @return \Illuminate\Http\Response
     */
    public function edit(Percent $percent)
    {
        return view('percents.edit', compact('percent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\UpdatePercentRequest  $request
     * @param  \App\Percent  $percent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePercentRequest $request, Percent $percent)
    {
        $this->percents->update($request, $percent);

        return redirect()->route('percents.index')->with('status', 'El porcentaje fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Percent  $percent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Percent $percent)
    {
        $this->percents->destroy($percent);

        return redirect()->route('percents.index')->with('status', 'El porcentaje fue eliminado con éxito');
    }
}

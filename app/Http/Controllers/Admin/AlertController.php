<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alert;
use App\Http\Requests\CreateAlert;
use App\Http\Requests\UpdateAlert;

class AlertController extends AdminController
{
    public function index()
    {
        $alerts = Alert::orderBy('from_date', 'desc')->get();

        return view('admin.alert.index', compact('alerts'));
    }

    public function create()
    {
        return $this->form(new Alert());
    }

    public function edit(Alert $alert)
    {
        return $this->form($alert);
    }

    protected function form(Alert $alert)
    {
        $routes = collect(Alert::AVAILABLE_ROUTES)
            ->mapWithKeys(fn($route) => [$route => route($route, [], false)]);

        return view('admin.alert.form', [
            'alert'  => $alert,
            'colors' => Alert::COLORS,
            'routes' => $routes,
        ]);
    }

    public function store(CreateAlert $request)
    {
        Alert::create($request->all());

        return redirect()
            ->route('admin.alert.index')
            ->with('success', 'Alert created!')
        ;
    }

    public function update(UpdateAlert $request, Alert $alert)
    {
        $alert->update($request->all());

        return redirect()
            ->route('admin.alert.index')
            ->with('success', 'Alert updated!')
        ;
    }

    public function destroy(Alert $alert)
    {
        $alert->delete();

        return redirect()
            ->route('admin.alert.index')
            ->with('success', 'Alert deleted!')
        ;
    }
}

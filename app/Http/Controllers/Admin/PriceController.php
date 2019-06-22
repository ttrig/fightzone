<?php

namespace App\Http\Controllers\Admin;

use App\Models\Price;

class PriceController extends AdminController
{
    public function index()
    {
        $prices = Price::with('activity')->get();
        return view('admin.price.index', compact('prices'));
    }

    public function update()
    {
        foreach (request()->all() as $activity_id => $input) {
            if (!is_array($input)) {
                continue;
            }

            $model = Price::where('activity_id', $activity_id)->firstOrFail();
            $model->update($input);
        }

        return redirect()
            ->route('admin.price.index')
            ->with('success', 'Prices updated!')
        ;
    }
}

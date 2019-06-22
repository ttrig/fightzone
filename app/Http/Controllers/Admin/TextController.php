<?php

namespace App\Http\Controllers\Admin;

use App\Models\Text;
use App\Http\Requests\UpdateText;

class TextController extends AdminController
{
    public function index()
    {
        $texts = Text::orderBy('route')->orderBy('name')->get();
        return view('admin.text.index', compact('texts'));
    }

    public function edit(Text $text)
    {
        $text->load(['audits' => function ($query) {
            $query->with('user')
                ->latest()
                ->take(10)
            ;
        }]);

        return view('admin.text.edit', compact('text'));
    }

    public function update(UpdateText $request, Text $text)
    {
        $text->update($request->except('redirect'));

        $redirect = $request->input('redirect', true)
            ? redirect()->route('admin.text.index')
            : back()
        ;

        return $redirect->with('success', 'Text updated!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreatePaymentArticle;
use App\Http\Requests\UpdatePaymentArticle;
use App\Models\PaymentArticle;

class PaymentArticleController extends AdminController
{
    public function index()
    {
        $articles = PaymentArticle::latest()->get();

        return view('admin.payment_article.index', compact('articles'));
    }

    public function create()
    {
        return $this->form(new PaymentArticle());
    }

    public function edit(PaymentArticle $article)
    {
        return $this->form($article);
    }

    protected function form(PaymentArticle $article)
    {
        return view('admin.payment_article.form', compact('article'));
    }

    public function store(CreatePaymentArticle $request)
    {
        PaymentArticle::create($request->all());

        return redirect()
            ->route('admin.payment_article.index')
            ->with('success', 'Article created!')
        ;
    }

    public function update(UpdatePaymentArticle $request, PaymentArticle $article)
    {
        $article->update($request->all());

        cache()->forget('billmate-payment-plans-for-article-' . $article->id);

        return redirect()
            ->route('admin.payment_article.index')
            ->with('success', 'Article updated!')
        ;
    }

    public function destroy(PaymentArticle $article)
    {
        $article->delete();

        return redirect()
            ->route('admin.payment_article.index')
            ->with('success', 'Article deleted!')
        ;
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PaymentArticle;
use App\Repositories\PageRepository;
use Ttrig\Billmate\Exceptions\BillmateException;
use Ttrig\Billmate\Service as BillmateService;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['throttle:12,1'])->only('checkout');
    }

    public function index(PageRepository $page)
    {
        return view('payment.index', [
            'texts' => $page->texts(),
            'articles' => PaymentArticle::active()->orderBy('name_sv')->get(),
        ]);
    }

    public function checkout(BillmateService $billmate, PaymentArticle $article)
    {
        try {
            $articles = collect()->push($article->billmateArticle());
            $checkout = $billmate->initCheckout($articles);
        } catch (BillmateException $exception) {
            logger()->critical($exception->getMessage(), compact('exception'));
        }

        return view('payment.checkout', [
            'article' => $article,
            'checkout' => $checkout ?? null,
        ]);
    }

    public function getMonthlyCosts(BillmateService $billmate)
    {
        if (! request()->wantsJson()) {
            abort(400);
        }

        $articles = PaymentArticle::active()->get();

        return $articles->mapWithKeys(function ($article) use ($billmate) {
            $cacheKey = 'billmate-payment-plans-for-article-' . $article->id;
            $plans = cache()->remember(
                $cacheKey,
                now()->addHours(4),
                fn() => $billmate->getPaymentPlans($article->billmateArticle())
            );

            $cost = ($yearPlan = collect($plans)->firstWhere('nbrofmonths', 12))
                ? $yearPlan['monthlycost'] / 100
                : null
            ;

            return [$article->number => $cost];
        });
    }
}

<?php

namespace App\Transformers;

use App\Models;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Models\Audit;

class AuditTransformer
{
    public const ICONS = [
        'created' => 'fa fa-plus',
        'updated' => 'fa fa-pencil-alt',
        'deleted' => 'fa fa-trash',
    ];

    public const TYPES = [
        Models\Alert::class => [
            'route' => 'admin.alert.edit',
            'name' => 'alert',
        ],
        Models\Event::class => [
            'route' => 'admin.event.edit',
            'name' => 'event',
        ],
        Models\Text::class => [
            'route' => 'admin.text.edit',
            'name' => 'text',
        ],
        Models\User::class => [
            'route' => 'admin.user.edit',
            'name' => 'user',
            'context' => [
                'created' => 'email.new',
                'deleted' => 'email.old',
            ],
        ],
        Models\PaymentArticle::class => [
            'route' => 'admin.payment_article.edit',
            'name' => 'payment article',
            'context' => [
                'created' => 'number.new',
                'deleted' => 'number.old',
            ],
        ],
    ];

    public function list(Collection $audits): array
    {
        return $audits
            ->filter(fn(Audit $audit) => isset(self::TYPES[$audit->auditable_type]))
            ->map(function (Audit $audit) {
                $type = self::TYPES[$audit->auditable_type];

                $audit->name = $type['name'];
                $audit->icon = self::ICONS[$audit->event];

                if ($audit->event === 'deleted') {
                    $audit->route = null;
                } else {
                    $audit->route = route($type['route'], $audit->auditable_id);
                }

                if (isset($type['context'][$audit->event])) {
                    $audit->context = data_get(
                        $audit->getModified(),
                        $type['context'][$audit->event]
                    );
                }

                return $audit;
            })
            ->all()
        ;
    }
}

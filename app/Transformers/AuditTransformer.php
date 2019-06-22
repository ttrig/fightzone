<?php

namespace App\Transformers;

use App\Models\Event;
use Illuminate\Support\Collection;
use OwenIt\Auditing\Models\Audit;

class AuditTransformer
{
    const ICONS = [
        'created' => 'fa fa-plus',
        'updated' => 'fa fa-pencil-alt',
        'deleted' => 'fa fa-trash',
    ];

    const TYPES = [
        \App\Models\Alert::class => [
            'route' => ['admin.alert.edit'],
            'name' => 'alert',
        ],
        \App\Models\Event::class => [
            'route' => ['admin.event.edit'],
            'name' => 'event',
        ],
        \App\Models\Price::class => [
            'route' => 'admin.price.index',
            'name' => 'prices',
        ],
        \App\Models\Text::class => [
            'route' => ['admin.text.edit'],
            'name' => 'text',
        ],
        \App\Models\User::class => [
            'route' => ['admin.user.edit'],
            'name' => 'user',
            'context' => [
                'created' => 'email.new',
                'deleted' => 'email.old',
            ],
        ],
    ];

    public function list(Collection $audits): array
    {
        return $audits->map(function (Audit $audit) {
            $type = self::TYPES[$audit->auditable_type];

            $audit->name = $type['name'];
            $audit->icon = self::ICONS[$audit->event];

            if ($audit->event !== 'deleted') {
                $audit->route = is_array($type['route'])
                    ? route($type['route'][0], $audit->auditable_id)
                    : route($type['route'])
                ;
            } else {
                $audit->route = null;
            }

            if (isset($type['context'][$audit->event])) {
                $audit->context = data_get($audit->getModified(), $type['context'][$audit->event]);
            }

            return $audit;
        })->all();
    }
}

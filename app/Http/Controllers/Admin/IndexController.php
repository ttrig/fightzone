<?php

namespace App\Http\Controllers\Admin;

use App\Models\Alert;
use App\Transformers\AuditTransformer;
use OwenIt\Auditing\Models\Audit;

class IndexController extends AdminController
{
    public function __invoke(AuditTransformer $auditTransformer)
    {
        $user = request()->user();
        $alerts = Alert::active()->get();

        $userAudits = $user->createdAudits()->limit(10)->get();
        $userAudits = $auditTransformer->list($userAudits);

        $allAudits = Audit::latest()->where('user_id', '<>', $user->id)->limit(10)->get();
        $allAudits = $auditTransformer->list($allAudits);

        return view('admin.index', compact('alerts', 'userAudits', 'allAudits'));
    }
}

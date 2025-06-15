<?php

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

function log_audit($action, $model = null, $data = [])
{
    AuditLog::create([
        'user_id' => Auth::id(),
        'action' => $action,
        'model_type' => $model ? get_class($model) : null,
        'model_id' => $model->id ?? null,
        'data' => $data,
    ]);
}
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPdfExport;
use Illuminate\Http\Request;
use App\Events\ExportPdfStatusUpdated;

class ExportPdfController extends Controller
{
    public function __invoke(Request $request){
        event(new ExportPdfStatusUpdated($request->user(), [
            'message' => 'Queing...',
        ]));

        ProcessPdfExport::dispatch($request->user());
        return response()->noContent();
    }
}

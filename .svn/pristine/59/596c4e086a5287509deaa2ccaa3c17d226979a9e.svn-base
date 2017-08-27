<?php

namespace App\Http\Middleware;

use App\DiagnosticFile;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckNotAcceptedFiles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        $file = new DiagnosticFile();
        $file = $file
            ->select(['id', 'status'])
            ->whereNull('deleted_at')
            ->where('user_id', $user->id)
            ->where('status', '<>', 'accepted')
            ->first();
        if (!empty($file)) {

            switch ($file->status) {
                case 'loaded':
                    return redirect()->route(
                        'loader/loadResult', [
                            'diagnostic_file_id' => $file->id,
                        ]
                    );
                    break;

                case 'errors':
                    return redirect()->route(
                        'loader/processingResult', [
                            'id' => $file->id,
                        ]
                    );
                    break;
            }
        }

        return $next($request);
    }
}

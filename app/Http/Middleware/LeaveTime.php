<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LeaveTime
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $logId = session('visitor_log_id');

        if ($logId) {
            // Cập nhật thời gian rời trang (nếu có logId)
            DB::table('visitor_logs')
                ->where('id', $logId)
                ->update(['leave_time' => Carbon::now(), 'updated_at' => Carbon::now()]);

            session()->forget('visitor_log_id');
        }
        return $next($request);
    }
}

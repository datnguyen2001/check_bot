<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DetectBot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $botUserAgents = [
            'googlebot', 'bingbot', 'slurp', 'duckduckbot', 'baiduspider',
            'yandexbot', 'sogou', 'exabot', 'facebot', 'ia_archiver'
        ];

        $userAgent = strtolower($request->header('User-Agent'));

        foreach ($botUserAgents as $bot) {
            if (strpos($userAgent, $bot) !== false) {

                return response()->view('bot', [], 403);
            }
        }

        $ip = $request->ip();
        $locationData = file_get_contents("http://ip-api.com/json/{$ip}");
        $location = json_decode($locationData, true);

        // Thời gian người dùng vào trang
        $enterTime = Carbon::now();

        // Lưu thông tin vào cơ sở dữ liệu
        $logId = DB::table('visitor_logs')->insertGetId([
            'ip' => $ip,
            'country' => $location['country'] ?? 'N/A',
            'city' => $location['city'] ?? 'N/A',
            'page' => $request->path(),
            'enter_time' => $enterTime,
            'created_at' => $enterTime,
            'updated_at' => $enterTime,
        ]);

        session(['visitor_log_id' => $logId]);

        if (in_array($location['country'], ['Singapore', 'Indonesia'])) {
            return response()->view('singapore-indo');
        }

        // Kiểm tra nguồn truy cập (Google hoặc quảng cáo)
        $referer = $request->headers->get('referer');

        // Nếu người dùng đến từ Google
        if (strpos($referer, 'google.com') !== false) {
            return $next($request);
        }

        // Nếu người dùng đến từ quảng cáo
        if (strpos($referer, 'utm_source=ad') !== false) {
            return response()->view('advertisement');
        }

        return $next($request);
    }
}

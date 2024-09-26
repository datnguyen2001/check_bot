<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['detect.bot'])->group(function () {
    Route::get('/login', function () {
        return view('login');
    });

    Route::get('/', function () {
        return view('welcome');
    });
});

Route::post('/update-leave-time', function () {
    $logId = session('visitor_log_id');

    if ($logId) {
        // Cập nhật thời gian rời trang
        \Illuminate\Support\Facades\DB::table('visitor_logs')
            ->where('id', $logId)
            ->update(['leave_time' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);
    }

    return response()->json(['status' => 'success']);
});

Route::get('/thong-ke-truy-cap', function () {
    $listData = \App\Models\VisitorLogsModel::orderBy('created_at','desc')->paginate(20);

    return view('access_statistics',compact('listData'));
});

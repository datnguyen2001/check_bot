<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Thống kê truy cập</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Template Main CSS File -->
    @yield('style')
</head>

<body>

<main>
    <div class="container">
        <p style="text-align: center;font-size: 26px;font-weight: bold;margin-top: 50px">Danh sách lượt truy cập trang web</p>
        <div class="mt-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th>IP</th>
                    <th>Quốc gia</th>
                    <th>Thành phố</th>
                    <th>Trang</th>
                    <th>Thời gian vào</th>
                    <th>Thời gian rời</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($listData as $key => $data)
                    <tr>
                        <td>{{ $key++ }}</td>
                        <td>{{ $data->ip }}</td>
                        <td>{{ $data->country }}</td>
                        <td>{{ $data->city }}</td>
                        <td>{{ $data->page }}</td>
                        <td>{{ $data->enter_time }}</td>
                        <td>{{ $data->leave_time ?? 'Đang truy cập' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-4">
            {{ $listData->links() }}
            </div>
        </div>
    </div>
</main><!-- End #main -->


<!-- Vendor JS Files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>

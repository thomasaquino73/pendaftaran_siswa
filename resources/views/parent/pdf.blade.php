<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center" style="margin:auto">DAFTAR BARANG</h1>
    <table class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>No. SKU</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($data as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                 
                    <td>{{ $item->nosku }}</td>
                    <td>{{ $item->namabarang }}</td>
                    <td>{{ $item->namakategori }}</td>
                    <td>{{ $item->namasatuan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

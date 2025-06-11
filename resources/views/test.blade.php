<!DOCTYPE html>
<html lang="en">

<head>
    <title>Halaman Tes</title>
</head>

<body>
    <h1>Tes Variabel Errors</h1>

    {{-- Kode ini akan mengecek apakah variabel $errors ada. --}}
    {{-- Jika ada dan kosong, akan tampil tulisan hijau. --}}
    {{-- Jika tidak ada, akan muncul error yang sama seperti sebelumnya. --}}

    @error('apapun')
    <p style="color: red; font-size: 24px;">Ini seharusnya tidak pernah muncul.</p>
    @else
    <p style="color: green; font-size: 24px;">
        SELAMAT! Variabel $errors ADA dan Berfungsi!
    </p>
    @enderror

</body>

</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Foto | Public Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f3f7ff, #ffffff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .form-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            max-width: 700px;
            width: 100%;
            animation: fadeIn 0.7s ease;
        }

        h2 {
            font-weight: 700;
            color: #333;
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            color: #444;
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 6px rgba(0,123,255,0.25);
        }

        .btn-submit {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, #0056b3, #00a2ff);
            transform: scale(1.05);
        }

        .btn-back {
            background: #f8f9fa;
            border-radius: 30px;
            border: 1px solid #ddd;
            font-weight: 600;
            color: #333;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: #e9ecef;
            transform: scale(1.05);
        }

        .alert {
            border-radius: 12px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 576px) {
            .form-card {
                padding: 25px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="form-card">
        <h2>🖼️ Tambah Foto ke Galeri</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠️ Perhatian!</strong> Ada kesalahan saat input:
                <ul class="mt-2 mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="judul">Judul Foto</label>
                <input type="text" name="judul" id="judul" class="form-control" placeholder="Masukkan judul foto" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi">Deskripsi (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Tuliskan keterangan singkat..."></textarea>
            </div>

            <div class="mb-3">
                <label for="gambar">Upload Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('galeri.index') }}" class="btn btn-back px-4">← Kembali</a>
                <button type="submit" class="btn-submit px-4">💾 Simpan</button>
            </div>
        </form>
    </div>

</body>
</html>
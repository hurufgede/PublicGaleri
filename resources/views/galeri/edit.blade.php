<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto | Public Galeri</title>
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

        .edit-card {
            background: #fff;
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            max-width: 700px;
            width: 100%;
            animation: fadeIn 0.7s ease;
        }

        h2 {
            text-align: center;
            font-weight: 700;
            color: #333;
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

        .preview-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
            border: 3px solid #f1f1f1;
            margin-bottom: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .preview-img:hover {
            transform: scale(1.03);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .btn-update {
            background: linear-gradient(135deg, #007bff, #00c6ff);
            border: none;
            border-radius: 30px;
            padding: 10px 25px;
            color: #fff;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-update:hover {
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

        .alert-danger {
            border-radius: 12px;
            font-size: 0.95rem;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(25px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 576px) {
            .edit-card {
                padding: 25px 20px;
            }

            .preview-img {
                height: 200px;
            }
        }
    </style>
</head>
<body>

    <div class="edit-card">
        <h2>✏️ Edit Foto Galeri</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠️ Perhatian!</strong> Ada kesalahan pada input:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul">Judul Foto</label>
                <input type="text" name="judul" id="judul" class="form-control" value="{{ $galeri->judul }}" required>
            </div>

            <div class="mb-3">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Tuliskan deskripsi...">{{ $galeri->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label>Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="Gambar Saat Ini" class="preview-img">
                <input type="file" name="gambar" class="form-control mt-2" accept="image/*">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar.</small>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('galeri.index') }}" class="btn btn-back px-4">← Kembali</a>
                <button type="submit" class="btn-update px-4">💾 Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>
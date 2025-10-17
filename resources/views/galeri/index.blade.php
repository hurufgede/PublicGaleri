<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Galeri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f3f7ff, #ffffff);
            font-family: 'Poppins', sans-serif;
        }

        .gallery-header {
            text-align: center;
            margin: 60px 0 30px;
        }

        .gallery-header h1 {
            font-weight: 700;
            color: #222;
            font-size: 2rem;
        }

        .gallery-header p {
            color: #666;
            font-size: 1rem;
            margin-top: 5px;
        }

        .btn-add {
            display: inline-block;
            padding: 10px 25px;
            background: linear-gradient(135deg, #007bff, #00c6ff);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 30px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-add:hover {
            transform: scale(1.05);
            background: linear-gradient(135deg, #0056b3, #0093e9);
            color: #fff;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            padding: 20px;
        }

        .gallery-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .gallery-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .gallery-card:hover img {
            transform: scale(1.07);
        }

        .card-body {
            padding: 15px 20px 20px;
        }

        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 5px;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
            min-height: 40px;
        }

        .btn-action {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .btn-action a,
        .btn-action button {
            flex: 1;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffb347, #ffcc33);
            border: none;
            color: #fff;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #ff9800, #ffc107);
            color: #fff;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ff4b5c, #ff6b6b);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #e63946, #ff5252);
        }

        .alert {
            width: 80%;
            margin: 0 auto 20px auto;
        }

        .empty-state {
            text-align: center;
            margin-top: 50px;
            color: #777;
        }

        .empty-state img {
            width: 150px;
            opacity: 0.8;
            margin-bottom: 15px;
        }

        .overlay {
            display: none;
            position: fixed;
            z-index: 9999;
            padding-top: 60px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.85);
        }

        .overlay-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 80vh;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(255,255,255,0.2);
            transition: transform 0.3s ease;
        }

        .overlay-content:hover {
            transform: scale(1.02);
        }

        .close-btn {
            position: absolute;
            top: 25px;
            right: 45px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .close-btn:hover {
            color: #bbb;
        }

        footer {
            text-align: center;
            padding: 25px;
            color: #777;
            font-size: 0.9rem;
            margin-top: 40px;
        }

        @media (max-width: 768px) {
            .gallery-header h1 {
                font-size: 1.5rem;
            }

            .btn-add {
                padding: 8px 20px;
                font-size: 0.9rem;
            }

            .gallery-grid {
                gap: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="gallery-header">
        <h1>📸 Public Galeri</h1>
        <p>Abadikan momen terbaikmu dalam web ini</p>
        <a href="{{ route('galeri.create') }}" class="btn-add mt-3">+ Tambah Foto</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if($data->count() == 0)
        <div class="empty-state">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="empty">
            <p>Belum ada foto di galeri.<br>Yuk tambahkan yang pertama!</p>
        </div>
    @else
    <div class="gallery-grid">
        @foreach($data as $item)
        <div class="gallery-card">
            <img src="{{ asset('storage/' . $item->gambar) }}" 
                alt="{{ $item->judul }}" 
                class="gallery-img" 
                style="cursor:pointer;" 
                data-img="{{ asset('storage/' . $item->gambar) }}">
            <div class="card-body">
                <h5 class="card-title">{{ $item->judul }}</h5>
                <p class="card-text">{{ Str::limit($item->deskripsi, 60) }}</p>
                <div class="btn-action">
                    <a href="{{ route('galeri.edit', $item->id) }}" class="btn btn-warning btn-sm">✏️ Edit</a>
                    <form action="{{ route('galeri.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus foto ini?')">🗑️ Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <footer>
        © {{ date('Y') }} Public Galeri | By: RosyadJKT
    </footer>
</div>

<div id="imgOverlay" class="overlay">
    <span class="close-btn" id="closePreview">&times;</span>
    <img id="overlayImg" class="overlay-content" src="">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('.gallery-img');
    const overlay = document.getElementById('imgOverlay');
    const overlayImg = document.getElementById('overlayImg');
    const closeBtn = document.getElementById('closePreview');

    images.forEach(img => {
        img.addEventListener('click', function() {
            overlay.style.display = "block";
            overlayImg.src = this.dataset.img;
        });
    });

    closeBtn.addEventListener('click', function() {
        overlay.style.display = "none";
        overlayImg.src = "";
    });

    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            overlay.style.display = "none";
            overlayImg.src = "";
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === "Escape") {
            overlay.style.display = "none";
            overlayImg.src = "";
        }
    });
});
</script>
</body>
</html>
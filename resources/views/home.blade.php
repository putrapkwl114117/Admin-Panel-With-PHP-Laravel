<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Home - MyStore</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
         body {
            background-color: #f8f9fa;
        }

        .card {
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        /* Menyelaraskan modal ke kiri */
        .modal {
            left: -450px;
            height: 100vh; /* Tinggi modal 75% dari viewport */
            overflow-y: auto; /* Menambahkan scroll jika isi lebih tinggi dari tinggi modal */
        }

        .modal-dialog {
            margin-top: 2%; /* Jarak dari atas */
        }

        .modal-content {
            height: 100%; /* Memastikan konten modal mengisi tinggi modal */
        }
        .card-img-top {
        height: 200px; /* Atur tinggi gambar */
        object-fit: cover; /* Memastikan gambar menutupi area yang tersedia */
    }

         .modal-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            /* text-align: center; Untuk memastikan teks terpusat */
        }

        .btn-custom {
        position: relative;
        overflow: hidden;
        border: none;
        background-color: burlywood
        border-radius: 5px;
        padding: 10px 20px;
        font-weight: bold;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }

.btn-custom:hover {
    background-color: #3b4c80; /* Warna latar belakang saat hover */
    color: white; /* Warna teks saat hover */
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); /* Bayangan saat hover */
}

.btn-custom i {
    margin-right: 5px; /* Jarak antara ikon dan teks */
}

.btn-custom::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.3);
    transform: translateY(-100%);
    transition: transform 0.5s ease;
    z-index: 0;
}

.btn-custom:hover::after {
    transform: translateY(0);
}

.btn-custom span {
    position: relative;
    z-index: 1; /* Menempatkan teks di atas efek hover */
}

.icon-buy {
    color: #28a745; /* Warna hijau untuk ikon Beli */
}

.icon-cart {
    color: #ffc107; /* Warna kuning untuk ikon Add to Cart */
}

.icon-detail {
    color: #007bff; /* Warna biru untuk ikon Detail */
}




        .card {
            height: 100%; 
        /* Pastikan card memanfaatkan semua ruang */
        }
        .navbar a {
            color: azure; /* Mengatur warna teks navbar menjadi azure */
            font-family: Verdana, Geneva, Tahoma, sans-serif; /* Mengatur font navbar */
        }

        /* Mengatur ukuran gambar carousel */
        .carousel-item img {
            height: 300px; /* Atur tinggi gambar */
            object-fit: cover; /* Memastikan gambar menutupi area yang tersedia */
        }

        .btn-icon-transparent {
            height: 54px;
            background-color: rgb(54, 54, 90); /* Mengatur latar belakang tombol menjadi transparan */
            border: none; /* Menghilangkan border tombol */
            color: inherit; /* Mengatur warna teks agar sesuai dengan warna teks yang ada */
            padding: 0; /* Menghilangkan padding untuk tombol */
        }
        .btn-icon-transparent span {
            color: white; /* Mengatur warna teks menjadi putih */
        }


        .btn-icon-transparent:hover {
            background-color: rgba(7, 1, 36, 0.425); /* Efek hover untuk memberikan sedikit warna saat dihover */
        }

     
    </style>
</head>

<body>

    <!-- Navbar -->
    <!-- Navbar -->
<nav class="navbar navbar-expand-lg" style="background-color: #3b4c80;">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">MyStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
     
                    <a class="nav-link active" aria-current="page" href="#">Beranda</a>
 
            <ul class="navbar-nav ms-auto"> <!-- Tambahkan ms-auto di sini -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<!-- Carousel -->
<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/artem-balashevsky-3nm9r82k8IQ-unsplash.jpg') }}" class="d-block w-100" alt="Gambar 1">
            <div class="carousel-caption d-none d-md-block">
                <form action="{{ route('search') }}" method="GET" class="search-form">
                    <div class="input-group">
                        <input type="text" name="query" class="form-control" placeholder="Cari produk..." aria-label="Cari produk" aria-describedby="button-search">
                        <button class="btn btn-primary" type="submit" id="button-search">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/abdul-raheem-kannath-A5ildxB6dtQ-unsplash.jpg') }}" class="d-block w-100" alt="Gambar 2">
            <div class="carousel-caption d-none d-md-block">
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari produk..." aria-label="Cari produk" aria-describedby="button-search">
                        <button class="btn btn-primary" type="button" id="button-search">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/artem-mihailov-e48PGxiwl9s-unsplash.jpg') }}" class="d-block w-100" alt="Gambar 3">
            <div class="carousel-caption d-none d-md-block">
                <form class="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari produk..." aria-label="Cari produk" aria-describedby="button-search">
                        <button class="btn btn-primary" type="button" id="button-search">Cari</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


<!-- Konten -->
<div class="container mt-5">
    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-3 mb-4">
                <div class="card shadow-sm">
                    <img src="{{ asset('storage/' . $post->path) }}" class="card-img-top" alt="{{ $post->produk_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->produk_name }}</h5>
                        <p class="card-text">Rp {{ number_format($post->price, 0, ',', '.') }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="#" class="btn btn-custom" data-bs-toggle="tooltip" title="Beli">
                                <i class="bi bi-cart-fill icon-buy"></i> <span>Beli</span>
                            </a>
                            <a href="#" class="btn btn-custom" data-bs-toggle="tooltip" title="Add to Cart">
                                <i class="bi bi-cart-plus-fill icon-cart"></i> <span>Add to Cart</span>
                            </a>
                            <a href="#" class="btn btn-icon-transparent" data-bs-toggle="modal" data-bs-target="#modalPost{{ $post->id }}" title="Detail">
                                <i class="bi bi-info-circle-fill icon-detail"></i> <span>Detail</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">Tidak ada produk yang ditemukan.</p>
        @endforelse
    </div>
</div>





    <!-- Include Modal -->
    @include('detail_post', ['posts' => $posts])

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.getElementById('button-search').addEventListener('click', function() {
        const query = document.getElementById('search-input').value;

        if (query.trim() === '') {
            alert('Masukkan kata kunci pencarian');
            return;
        }

        fetch(`/search?query=${encodeURIComponent(query)}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Clear any previous results
            let resultHTML = '';

            if (data.length === 0) {
                resultHTML = '<p class="text-center">Tidak ada produk yang ditemukan.</p>';
            } else {
                data.forEach(post => {
                    resultHTML += `
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm">
                                <img src="/storage/${post.path}" class="card-img-top" alt="${post.produk_name}">
                                <div class="card-body">
                                    <h5 class="card-title">${post.produk_name}</h5>
                                    <p class="card-text">Harga: Rp ${new Intl.NumberFormat('id-ID').format(post.price)}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="#" class="btn btn-custom" data-bs-toggle="tooltip" title="Beli">
                                            <i class="bi bi-cart-fill icon-buy"></i> <span>Beli</span>
                                        </a>
                                        <a href="#" class="btn btn-custom" data-bs-toggle="tooltip" title="Add to Cart">
                                            <i class="bi bi-cart-plus-fill icon-cart"></i> <span>Add to Cart</span>
                                        </a>
                                        <a href="#" class="btn btn-icon-transparent" data-bs-toggle="modal" data-bs-target="#modalPost${post.id}" title="Detail">
                                            <i class="bi bi-info-circle-fill icon-detail"></i> <span>Detail</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }

            // Update the DOM with new search results
            document.querySelector('.row').innerHTML = resultHTML;
        })
        .catch(error => console.error('Error:', error));
    });

    // Optional: Enable search on pressing 'Enter' key
    document.getElementById('search-input').addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            document.getElementById('button-search').click();
        }
    });
</script>

</body>

</html>

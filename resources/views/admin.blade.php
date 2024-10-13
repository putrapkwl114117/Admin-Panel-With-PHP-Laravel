<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <style>
body {
    background: #e6e6ff; 
    color: #1e0f44; 
    font-family: Arial, sans-serif;
    margin: 0; 
    
}


.sidebar {
    width: 250px;
    height: 100%;
    background: linear-gradient(to right, #1e0f44, #49368a); 
    position: fixed;
    transition: width 0.3s;
    display: flex;
    flex-direction: column; 
    justify-content: flex-start; 
    align-items: center;
    padding: 20px; 
    margin-bottom: 20px; 
    border-right: 2px solid rgba(255, 255, 255, 0.2); 
    border-bottom-right-radius: 15px;
}

.sidebar.collapsed {
    width: 80px;
}

.sidebar a {
    padding: 10px 15px;
    text-decoration: none;
    font-size: 18px;
    color: #fff;
    display: flex; 
    align-items: center; 
    margin-bottom: 10px;
    transition: color 0.3s;
}

.sidebar a:hover {
    color: rgb(61, 17, 255); 
    border-radius: 5px;
}

.text-link {
    display: flex;
    align-items: center; 
    text-decoration: none; 
    color: #fff; 
    padding: 10px 15px; 
    margin: 5px 0; 
}

.text-link i {
    margin-right: 8px;
}

#all-posts-btn {
    margin-bottom: 50px; 
}

.add-post,
.add-user {
    margin: 0 0; 
}

.settings-link {
    margin-top: auto; 
    margin-bottom: 30px; 
}



.toggle-btn {
    color: #fff; 
    border: none;
    font-size: 18px;
    cursor: pointer;
    position: absolute;
    top: 50%;
    left: 100%;
    transform: translate(-50%, -50%); 
    border-radius: 50%; 
    background: linear-gradient(135deg, #7951dd, #392b66); 
    padding: 10px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    transition: background 0.3s, transform 0.3s; 
}

/* Efek hover */
.toggle-btn:hover {
    background: linear-gradient(135deg, #2d1d61, #1e0f44);
    transform: translate(-50%, -50%) scale(1.05); 
}

    .sidebar.collapsed ~ .toggle-btn {
        left: 90px;
        transform: translate(-50%, -50%); 
        background-color: transparent;
    }

    .sidebar img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-top: 20%;
    }

    .sidebar p {
      color: #fff;
      margin-top: 10px;
    }
    
.main-content {
    position: relative;
    margin-left: 250px; 
    padding: 100px;
    width: calc(100% - 250px); 
    transition: margin-left 0.3s, width 0.3s; 
}

.sidebar.collapsed ~ .main-content {
    margin-left: 80px; 
    width: calc(100% - 80px); 
}

.sidebar.collapsed .main-content table {
    width: 100%;
}

.navbar {
    position: fixed;
    left: 250px;
    z-index: 10;
    height: 10%;
    top: 0; 
    width: calc(100% - 250px);
    background: linear-gradient(to right, #8471c0, #8e7cc7); 
    padding: 10px 20px;
    color: #1e0f44;
    border: 2px solid transparent;
    border-top-right-radius: 8px; 
    border-bottom-right-radius: 8px; 
    box-shadow: 
        0 2px 5px rgba(0, 0, 0, 0.2), 
        0 4px 10px rgba(0, 0, 0, 0.15), 
        0 8px 20px rgba(0, 0, 0, 0.1);  
}

.sidebar.collapsed ~.navbar {
    margin-left: 80px;
    left: 0;
    width: calc(100% - 80px);
}

    .table thead {
      background-color: #6c757d;
      color: white;
    }

    .table td, .table th {
      vertical-align: middle;
    }

    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }

 .nav-link {
        color: #000000; 
         font-size: 16px;
         cursor: pointer;
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    }

    .nav-link:hover {
        color: #331b80;
    }
     .nav-item:hover a {
        color: #331b80;
    }

  .nav-item a{
        color: #000000;
        font-size: 16px;
        cursor: pointer;
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    }

    .sidebar.collapsed .rounded-circle {
    width: 50px; 
    height: 50px; 
}

.sidebar.collapsed p {
    font-size: 14px; 
    margin-top: 5px;
}
.sidebar.collapsed a {
    font-size: 14px; 
    margin-top: 5px;
}

  </style>
</head>
<body>

 <!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <button class="toggle-btn" id="toggle-btn">X</button>
    <div class="text-center mb-4">
        <img src="https://via.placeholder.com/80" class="rounded-circle" alt="Admin Icon">
        <p class="text-white mt-2">{{ auth()->user()->name }}</p> <!-- Nama Admin -->
    </div>
    <a href="#" id="all-posts-btn" class="text-link all-post">
        <i class="bi bi-card-list"></i> All Posts
    </a>
    <a href="#" data-bs-toggle="modal" data-bs-target="#createPostModal" class="text-link add-post">
        <i class="bi bi-plus-circle"></i> Add Post
    </a>
    <a href="#" id="addd_user_btn" data-bs-toggle="modal" data-bs-target="#createUserModal" class="text-link add-user">
        <i class="bi bi-person-plus-fill"></i> Add User
    </a>
    <a href="#" class="text-link settings-link">
        <i class="bi bi-gear-fill"></i> Settings
    </a>
</div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-success">
    <div class="container-fluid">
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item d-flex align-items-center"> 
                    <a href="{{ route('home') }}" target="_blank" class="text-link me-3"> 
                        <i class="bi bi-house-door"></i> Go to Home
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <div class="d-flex justify-content-between mb-3">
            <a href="#" id="add_user_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">Add User</a>
            <a href="#" id="add_post_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">Create Post</a>
            <!-- modal untuk menambah pengguna -->
            @include('create')
            @include('create_post')
            @include('update_produk')
            <form action="{{ route('admin.users.search') }}" method="GET" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" name="query" placeholder="Search" aria-label="Search" required>
                              <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <div id="success-message" class="alert alert-success" role="alert" style="display: none;">
           Post berhasil ditambahkan!
   </div>
        <div id="success-message" style="display: none;"></div>
         @include('all_post')

        <table class="table table-striped" id="user-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <!-- Button to trigger modal -->
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editModal{{ $user->id }}">
                        Edit
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                                        </div>
                                         <div class="form-group">
                                            <label for="role-{{ $user->id }}">Role:</label>
                                            <select class="form-control" id="role-{{ $user->id }}" name="role" required>
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update User</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                 <!-- Tombol Delete -->
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $user->id }}">
                        Delete
                    </button>

                    <!-- Modal Konfirmasi Hapus -->
                <div class="modal fade" id="confirmDeleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"  aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete this user?
                                                    </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" id="deleteForm{{ $user->id }}" style="display:inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                                </form>
                                                                </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>

                                        <!-- Toast Notification -->
                                    <div id="toastContainer" aria-live="polite" aria-atomic="true" style="position: absolute; top: 20px; right: 20px;">
                                        <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="display: none;">
                                            <div class="toast-header">
                                                <strong class="me-auto">Notification</strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                            <div class="toast-body">
                                                User deleted successfully.
                                            </div>
                                        </div>
                                    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
     document.getElementById('toggle-btn').addEventListener('click', function () {
          var sidebar = document.getElementById('sidebar');
          var mainContent = document.getElementById('main-content');
          
          sidebar.classList.toggle('collapsed');
          mainContent.classList.toggle('collapsed');
          });

</script>

<script>
    $(document).ready(function() {
    $('#add_post_btn').hide();

    // Mengambil dan menampilkan semua postingan saat tombol "All Posts" diklik
    $('#all-posts-btn').click(function(event) {
        event.preventDefault(); 

        // Toggle tampilan tabel user dan post
        $('#user-table').toggle(); 
        $('#posts-table').toggle(); 

        // Ubah teks tombol "All Posts" menjadi "All Users" saat tabel post terlihat
        if ($('#posts-table').is(':visible')) {
            $('#all-posts-btn').text('All Users');
            $('#add_user_btn').hide(); 
            $('#add_post_btn').show(); 
            loadPosts(); 
        } else {
            $('#all-posts-btn').text('All Posts');
            $('#add_user_btn').show(); 
            $('#add_post_btn').hide(); 
            loadUsers(); 
        }
    });

    // Event listener untuk form pencarian
    $('#dynamic-search-form').submit(function(e) {
        e.preventDefault(); 
        const query = $('input[name="query"]').val();
        // Memanggil fungsi untuk memuat postingan dengan query pencarian
        loadPosts(query);
    });

function loadPosts(query = '') {
    $.ajax({
        url: "{{ route('admin.posts.search') }}", // Rute pencarian postingan
        type: "GET",
        data: { query: query }, 
        success: function(response) {
            if (!Array.isArray(response.data)) { // Periksa array di dalam objek 'data'
                alert('Data tidak dalam format array');
                return;
            }
            let rows = '';
            if (response.data.length === 0) {
                rows = `
                    <tr>
                        <td colspan="6" class="text-center">Belum ada Data Barang yang dibuat</td>
                    </tr>
                `;
            } else {
                response.data.forEach(post => {
                    rows += `
                        <tr id="post-${post.id}">
                            <td>${post.id}</td>
                            <td>${post.produk_name}</td>
                            <td>${post.descripsi}</td>
                            <td>${post.price}</td>
                            <td>${post.stock}</td>
                            <td><img src="/storage/${post.path}" alt="Image" style="max-width: 50px;"></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-primary edit-post-btn" 
                                data-id="${post.id}" 
                                data-name="${post.produk_name}" 
                                data-description="${post.descripsi}" 
                                data-price="${post.price}" 
                                data-stock="${post.stock}" 
                                data-path="${post.path}">Edit</a>
                                <form action="/admin/posts/${post.id}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    `;
                });
            }

            // Update tabel post
            $('#posts-table tbody').html(rows);
            applyEditEventListener();
        },
        error: function() {
            alert('Error loading posts.');
        }
    });
}

// Function to reapply event listener to edit buttons after loading posts
function applyEditEventListener() {
    $(document).on('click', '.edit-post-btn', function() {
        const id = $(this).data('id');
        const name = $(this).data('name');
        const description = $(this).data('description');
        const price = $(this).data('price');
        const stock = $(this).data('stock');
        const path = $(this).data('path');

        // Isi modal dengan data post
        $('#editModalPost #produk_name').val(name);
        $('#editModalPost #descripsi').val(description);
        $('#editModalPost #price').val(price);
        $('#editModalPost #stock').val(stock);
        $('#editModalPost #existing_path').val(path); // Simpan path yang ada jika ada

        // Menampilkan gambar saat ini jika ada
        if (path) {
            $('#editModalPost #current_image').attr('src', `/storage/${path}`).show();
        } else {
            $('#editModalPost #current_image').hide();
        }
        $('#editForm').attr('action', `/admin/posts/${id}`);
        $('#editModalPost').modal('show');
    });
}

applyEditEventListener();

// Event listener untuk submit form update
$('#editForm').submit(function(e) {
    e.preventDefault(); 

    const form = $(this);
    const actionUrl = form.attr('action');
    const formData = new FormData(this); 
    $.ajax({
        url: actionUrl,
        type: 'POST', 
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            $('#editModalPost').modal('hide');
            loadPosts();
            $('#success-message').text('Post berhasil diupdate!').fadeIn().delay(3000).fadeOut(); 
        },
        error: function() {
            alert('Error updating post.');
            }
        });
    });
});

</script>

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var toastEl = document.getElementById('toast');
            var toast = new bootstrap.Toast(toastEl);
            toast.show();
        });
    </script>
@endif

</body>
</html>

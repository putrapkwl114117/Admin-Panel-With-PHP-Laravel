<!-- Modal Add Post -->
<div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Add New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-post-form" method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                    @csrf <!-- Pastikan ada CSRF token -->
                    <div class="mb-3">
                        <label for="produk_name" class="form-label">Produk Name</label>
                        <input type="text" class="form-control" id="produk_name" name="produk_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripsi" class="form-label">Descripsi</label>
                        <textarea class="form-control" id="descripsi" name="descripsi" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="path" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="path" name="path" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Post</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Delete -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus post ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirm-delete-btn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<!-- Success/Error Message -->
<div id="success-message" class="alert alert-success" style="display: none;"></div>
<div id="error-message" class="alert alert-danger" style="display: none;"></div>

<script>
$(document).ready(function() {
    // Event listener untuk submit form add post
    $('#add-post-form').submit(function(e) {
        e.preventDefault(); // Mencegah form submit default

        const form = $(this);
        const actionUrl = form.attr('action'); // URL tujuan
        const formData = new FormData(this); // FormData untuk menangani file upload

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false, // Tidak memproses data sebagai string
            contentType: false, // Jangan menetapkan contentType karena kita mengirimkan file
            success: function(response) {
                // Jika berhasil, tutup modal
                $('#createPostModal').modal('hide');
                
                // Reset form input setelah submit
                $('#add-post-form')[0].reset();

                // Tambahkan postingan baru ke tabel di bagian atas
                const newRow = `
                    <tr>
                        <td>${response.id}</td>
                        <td>${response.produk_name}</td>
                        <td>${response.descripsi}</td>
                        <td>${response.price}</td>
                        <td>${response.stock}</td>
                        <td><img src="/storage/${response.path}" alt="Gambar" style="max-width: 50px;"></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-primary edit-post-btn" 
                               data-id="${response.id}" 
                               data-name="${response.produk_name}" 
                               data-description="${response.descripsi}" 
                               data-price="${response.price}" 
                               data-stock="${response.stock}" 
                               data-path="/storage/${response.path}">Edit</a>
                            <form action="/admin/posts/${response.id}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                `;

                // Tambahkan row baru di atas tabel
                $('#posts-table tbody').prepend(newRow);

                // Tampilkan pesan sukses
                $('#success-message').text('Post berhasil ditambahkan!').fadeIn().delay(3000).fadeOut(); // Tampilkan dan sembunyikan alert
            },
            error: function(xhr) {
                $('#error-message').text('Error creating post: ' + xhr.responseText).fadeIn().delay(3000).fadeOut(); // Tampilkan pesan error
            }
        });
    });

    // Event listener untuk tombol delete
    let postIdToDelete;

    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault(); // Mencegah perilaku default dari form
        postIdToDelete = $(this).closest('form').attr('action').split('/').pop();
        $('#confirmDeleteModal').modal('show'); // Tampilkan modal konfirmasi
    });

    // Event listener untuk konfirmasi penghapusan
    $('#confirm-delete-btn').click(function() {
        $.ajax({
            url: `/admin/posts/${postIdToDelete}`, // URL untuk menghapus post
            type: 'POST',
            data: {
                _method: 'DELETE', // Menggunakan metode DELETE
                _token: '{{ csrf_token() }}' // CSRF token
            },
            success: function(response) {
                // Setelah berhasil menghapus, sembunyikan modal
                $('#confirmDeleteModal').modal('hide');
                $(`form[action="/admin/posts/${postIdToDelete}"]`).closest('tr').remove(); // Hapus row dari tabel
                $('#success-message').text('Post berhasil dihapus!').fadeIn().delay(3000).fadeOut(); // Tampilkan pesan sukses
            },
            error: function(xhr) {
                $('#error-message').text('Error deleting post: ' + xhr.responseText).fadeIn().delay(3000).fadeOut(); // Tampilkan pesan error
            }
        });
    });
});
</script>

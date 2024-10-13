<!-- Modal Edit -->
<!-- jQuery -->

<div class="modal fade" id="editModalPost" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="produk_name" class="form-label">Produk Name</label>
                        <input type="text" class="form-control" id="produk_name" name="produk_name" required>
                    </div>

                    <div class="mb-3">
                        <label for="descripsi" class="form-label">Descripsi</label>
                        <textarea class="form-control" id="descripsi" name="descripsi" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" required>
                    </div>

                    <div class="mb-3 d-flex align-items-center">
                         <div class="mr-3">
                            <label for="new_image" class="form-label"></label>
                            <input type="file" class="form-control" id="new_image" name="new_image" accept="image/*">
                        </div>

                        <div>
                            <label for="current_image" class="form-label"></label>
                            <img id="current_image" src="" alt="Image" style="max-width: 50px; display: block;">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
          $(document).on('click', '[data-dismiss="modal"]', function() {
    $('#editModalPost').modal('hide');
});

</script>
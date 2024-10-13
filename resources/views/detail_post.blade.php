@foreach($posts as $post)
    <!-- Modal -->
    <div class="modal fade" id="modalPost{{ $post->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $post->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content" style="height: 80vh;">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel{{ $post->id }}">{{ $post->produk_name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex flex-column justify-content-center align-items-center">
                    <img src="{{ asset('storage/' . $post->path) }}" class="img-fluid mb-3" alt="{{ $post->produk_name }}" style="max-height: 200px; width: auto;">
                    <p>{{ $post->descripsi }}</p>
                    <p>Harga: Rp {{ number_format($post->price, 0, ',', '.') }}</p>
                    <p>Stok: {{ $post->stock }}</p>
                    <div class="mb-2">
                        <strong>Rating: </strong>
                        <span>{{ $post->rating ?? 'Belum ada rating' }}</span>
                    </div>
                </div>
                <div class="modal-footer">
                     <a href="#" class="btn btn-custom" data-bs-toggle="tooltip" title="Beli">
                        <i class="bi bi-cart-fill icon-buy"></i> <span>Beli</span>
                    </a>
                    <a href="#" class="btn btn-custom" data-bs-toggle="tooltip" title="Add to Cart">
                        <i class="bi bi-cart-plus-fill icon-cart"></i> <span>Add to Cart</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
@endforeach

<script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
</script>

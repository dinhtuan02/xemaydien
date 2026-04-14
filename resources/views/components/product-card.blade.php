<div class="col-md-3 mb-4">
    <div class="card h-100 shadow-sm border-0 product-card">
        <a href="{{ route('products.show', $product->slug) }}">
            <img src="{{ $product->thumbnail_url }}" class="rounded" alt="{{ $product->name }}">
        </a>

        <div class="card-body d-flex flex-column">
            <h6 class="card-title">
                <a href="{{ route('products.show', $product->slug) }}" class="text-decoration-none text-dark">
                    {{ $product->name }}
                </a>
            </h6>

            <div class="small text-muted mb-2">
                {{ $product->brand->name ?? 'N/A' }}
            </div>

            <div class="mb-2">
                @if($product->sale_price)
                    <span class="text-danger fw-bold">{{ number_format($product->sale_price) }}đ</span>
                    <small class="text-muted text-decoration-line-through">{{ number_format($product->price) }}đ</small>
                @else
                    <span class="text-danger fw-bold">{{ number_format($product->price) }}đ</span>
                @endif
            </div>

            <div class="small text-warning mb-3">
                ★ {{ $product->average_rating }}/5
            </div>

            <div class="mt-auto d-grid gap-2">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary btn-sm w-100">Thêm vào giỏ</button>
                </form>
                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-secondary btn-sm">Xem chi tiết</a>
            </div>
        </div>
    </div>
</div>
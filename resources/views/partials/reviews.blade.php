@if ($reviews->isNotEmpty())
    @foreach ($reviews as $review)
        <div class="product-single__reviews-item">
            <div class="customer-avatar">
                <img loading="lazy" src="{{ asset('images/avatar/avatar-icon0002_750950-43-removebg-preview.png') }}"
                    alt="User Avatar" />
            </div>
            <div class="customer-review">
                <div class="customer-name">
                    <h6>{{ $review->user->name }}</h6>
                    <div class="reviews-group d-flex">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_star"
                                    style="fill: {{ $i <= $review->rating ? '#ffcc00' : '#ccc' }};" />
                            </svg>
                        @endfor
                    </div>
                </div>
                <div class="review-date">{{ $review->created_at->format('F d, Y') }}</div>
                <div class="review-text">
                    <strong style="color: #000">{{ $review->review }}</strong>
                </div>
            </div>
        </div>
    @endforeach
@else
    <p>No reviews available for this product yet.</p>
@endif

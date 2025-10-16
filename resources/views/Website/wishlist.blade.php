@extends('layouts.app')

@section('title', 'Wishlist')

@section('content')
    <main class="pt-90">
        <div class="pb-4 mb-4"></div>
        <section class="container shop-checkout">
            <h2 class="page-title">Wishlist</h2>

            <div class="shopping-cart">
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($items as $item)
                                <tr>
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            <img loading="lazy"
                                                src="{{ asset('storage/uploads/products/' . $item->model->image) }}"
                                                width="120" height="120" alt="{{ $item->model->name }}" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>{{ $item->name }}</h4>
                                            <ul class="shopping-cart__product-item__options">
                                                <li>Category: {{ $item->model->category->name }}</li>
                                                <li>Stock_Status: <b
                                                        style="{{ $item->model->stock_status == 'instock' ? 'color:green' : 'color:red' }}">{{ $item->model->stock_status }}</b>
                                                </li>
                                                <li style="display: flex; margin-top: 20px"> <span
                                                        style="margin-top: 10px; font-weight: bold; color: black;">
                                                        Size: </span>
                                                    @php

                                                        $sizeLabels = [
                                                            'xs' => 'Extra Small(XS)',
                                                            's' => 'Small (S)',
                                                            'm' => 'Medium (M)',
                                                            'l' => 'Large (L)',
                                                            'xl' => 'Extra Large (XL)',
                                                            'xxl' => 'Double Extra Large (XXL)',
                                                        ];

                                                        $sizes = json_decode($item->model->sizes, true);
                                                    @endphp

                                                    <select class="form-select"
                                                        style="width: 150px; height: 55px; border-radius: 10px; margin-left: 5px;"
                                                        name="size" id="size">
                                                        <option value="">Select Size</option>
                                                        @if (!empty($sizes) && is_array($sizes))
                                                            @foreach ($sizes as $size)
                                                                <option value="{{ $size }}">
                                                                    {{ $sizeLabels[strtolower($size)] ?? strtoupper($size) }}
                                                                </option>
                                                            @endforeach
                                                        @else
                                                            <option value="">No sizes available</option>
                                                        @endif
                                                    </select>

                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__product-price">${{ $item->price }}</span>
                                    </td>
                                    <td>
                                        {{ $item->qty }}
                                    </td>

                                    <td>
                                        <span class="shopping-cart__subtotal">${{ $item->total }}</span>
                                    </td>
                                    @if ($item->model->stock_status == 'outofstock')
                                        <td>


                                            <button class="btn btn-sm "
                                                style=" background-color: rgba(211, 71, 71, 0.459); color: black;"
                                                title="Move to Cart">Out Of
                                                Stock</button>

                                        </td>
                                    @else
                                        <td>
                                            @if (Cart::instance('cart')->content()->where('id', $item->id)->count() > 0)
                                                <form action="{{ route('cart.index') }}">
                                                    <button type="submit" class="btn btn-sm btn-info"
                                                        title="Move to Cart">Go
                                                        To Cut</button>

                                                </form>
                                            @else
                                                <form id="wish-form"
                                                    action="{{ route('wishlist.moveToCut', $item->rowId) }}"
                                                    method="post">
                                                    @csrf
                                                    <input type="hidden" name="size" id="selected_size" value="">
                                                    <button type="submit" class="btn btn-sm btn-warning"
                                                        title="Move to Cart">Move
                                                        to Cart</button>
                                                </form>
                                            @endif
                                        </td>
                                    @endif
                                    <td>



                                        <form id="frm" method="post"
                                            action="{{ route('wishlist.remove', $item->rowId) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" class="remove-cart" title="Remove Wishlist Item"
                                                onclick="document.getElementById('frm').submit()">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                    <path
                                                        d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                </svg>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @empty

                                <tr>
                                    <td colspan="6">
                                        <h4 class="text-center">No items in wishlist</h4>
                                    </td>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                    @if ($items->count() > 0)
                        <div class="cart-table-footer">
                            <form action="{{ route('wishlist.empty') }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-light" title="Clear Wishlist"> <span
                                        style="font-weight: 500;"> Clear
                                        Wishlist</span></button>
                            </form>
                        </div>
                    @endif

                </div>

            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Listen for changes to the size select dropdown
            document.getElementById("size").addEventListener("change", function() {
                let selectedSize = this.value;

                // If a size is selected, set the value to the hidden input
                document.getElementById("selected_size").value = selectedSize;

            });

            // Handle form submission
            document.getElementById("wish-form").addEventListener("submit", function(event) {
                let selectedSize = document.getElementById("size").value;

                // If no size is selected, show alert and prevent form submission
                if (selectedSize == '') {
                    alert('Please select a size before submitting the cart.');
                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
@endpush

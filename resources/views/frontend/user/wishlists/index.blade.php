@extends('frontend.layouts.fullLayoutMaster')

@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Wishlist
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (!empty($product) && count($product) > 0)
                    <div class="table-responsive">
                        <table class="table shopping-summery text-center">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col" colspan="2">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Stock Status</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $products)
                                <tr>
                                    <td class="image product-thumbnail"><img src="{{ URL::asset('public/images/product/'.$products->getWishlistInformation->thumbnail)}}" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h5 class="product-name"><a href="{{ route('user.shop-detail',$products->getWishlistInformation->slug) }}">{{ $products->getWishlistInformation->name }}</a></h5>
                                        <p class="font-xs">{{ $products->getWishlistInformation->category->name }}/{{ $products->getWishlistInformation->subcategory->name }}<br>
                                    </td>
                                    @if ($countryPrice == 'IN')
                                        <td class="price" data-title="Price"><span>₹{{ $products->getWishlistInformation->selling_price }} </span></td>
                                    @else
                                        <td class="price" data-title="Price"><span>${{ $products->getWishlistInformation->selling_price_dollar }} </span></td>
                                    @endif
                                    <td class="text-center" data-title="Stock">
                                        <span class="color3 font-weight-bold">In Stock</span>
                                    </td>
                                    <td class="text-right" data-title="Action">
                                        <a href="{{ route('user.shop-detail',$products->getWishlistInformation->slug) }}" class="btn btn-sm"><i class="fa-regular fa-eye"></i></i> View</a>
                                    </td>
                                    <td class="action" data-title="Remove"><a href="#" data-product_id="{{$products->getWishlistInformation->id}}" data-wishlist_item_id="{{$products->id}}" class='remove-to-wishlist1' data-remove_url="{{route('wishlists.show',$products->id)}}" href="javascript:void(0);" onclick="event.preventDefault();
                                        document.getElementById('delete-wishlist-'+'{{$products->id}}').submit();"><i class="fi-rs-trash"></i></a>
                                        <form  method="POST" id='delete-wishlist-{{$products->id}}' action="{{route('wishlists.show',$products->id)}}" accept-charset="UTF-8" class="d-none">
                                            @method("DELETE")
                                            @csrf
                                        </form></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-lg-4 col-md-2">
                        </div>
                            <div class="col-lg-4 col-md-2 text-center">
                                <img src="{{ asset('public/frontend\assets\imgs\banner\empty_wishlist_red.jpg') }}" alt="" >
                            <h3>Your Wishlist is Empty</h3>
                        </div>
                        <div class="col-lg-4 col-md-2">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('page-script')

@endsection

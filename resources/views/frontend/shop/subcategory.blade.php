@extends('frontend.layouts.fullLayoutMaster')

@section('content')
<style>
.match-height > [class*=col] {
    display: flex;
    flex-flow: column;
}
.match-height > [class*=col] > .product-cart-wrap {
    flex: 1 1 auto;
}
</style>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                <span></span> <a href="{{ route('user.shop') }}" rel="nofollow">Shop</a>
                <span></span> Category
                <span></span> {{ $category_name->name }}
            </div>
        </div>
    </div>
    <section class="featured">
        <div class="container">
            <h3 class="section-title mb-20 mt-20"><span>Sub </span> Categories</h3>
            <div class="row product-grid-3 match-height">
                @if (count($subCategory) > 0)
                @foreach ($subCategory as $subCategories)
                <div class="col-lg-2 col-md-4 col-12 col-sm-6">
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-img product-img-zoom">
                                <a href="{{ route('user.shop-category',['cat'=>$category_name->slug,'subcat'=>$subCategories->slug]) }}">
                                    <img class="default-img sub_category" src="{{ asset('public/images/subcategory/thumbnail/'.$subCategories->thumbnail) }}"
                                        alt="">
                                    <img class="hover-img sub_category" src="{{ asset('public/images/subcategory/thumbnail/'.$subCategories->thumbnail) }}"
                                        alt="">
                                </a>
                            </div>
                        </div>
                        <div class="product-content-wrap" style="text-align: center">
                            <div class="product-category">
                                <a href=""></a>
                            </div>
                            <h5><a href="{{ route('user.shop-category',['cat'=>$category_name->name,'subcat'=>$subCategories->name]) }}">{{ ucfirst($subCategories->name) }}</a></h5>
                            <div style="display: flex">
                                </div>
                            </div>
                            <div class="product-price">
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="col-lg-4 col-md-4">
                </div>
                <div class="col-lg-3 col-md-4">
                    <div class="product-cart-wrap mb-30">
                        <div class="product-img-action-wrap">
                            <div class="product-content-wrap">
                            <h2 class="mt-3" style="text-align: center;"><a href="#">Sub-Category Not Found</a></h2>
                            </div>

                        </div>
                    </div>
                </div>
                @endif
                </div>
            </div>
            </div>
        </div>
    </section>
</main>

@endsection

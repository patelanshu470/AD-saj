@foreach ($image_highlight as $image_highlights)
<div class="col-lg-3 col-6 col-md-4">
    <div class="product-cart-wrap mb-30 pb-10">
        <div class="product-img-action-wrap">
            <div class="product-img product-img-zoom" style="height: 305px;">
                <a href="javascript:void(0)">
                <img class="default-img highlight modal-target"
                    src="{{ URL::asset('public/images/highlights/images/'.$image_highlights->path)}}"
                    alt="">
                <img class="hover-img highlight modal-target"
                    src="{{ URL::asset('public/images/highlights/images/'.$image_highlights->path)}}"
                    alt="">
                </a>
            </div>
            <div class="product-action-1">
            </div>
            <div class="product-badges product-badges-position product-badges-mrg">
            </div>
        </div>
    </div>
</div>
@endforeach

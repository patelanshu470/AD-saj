@extends('frontend.layouts.fullLayoutMaster')

@section('page-style')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
    .pagination-area li {
  margin: 0 5px;
}
.pagination-area li:first-child {
  margin-left: 0;
}

.pagination-area li.active span, .pagination-area li:hover span {
  color: #fff;
  background: #cd4040;
}

.pagination-area span {
  border: 0;
  padding: 0 10px;
  -webkit-box-shadow: none;
          box-shadow: none;
  outline: 0;
  width: 34px;
  height: 34px;
  display: block;
  border-radius: 4px;
  color: #696969;
  line-height: 34px;
  text-align: center;
  font-weight: 700;
}

.pagination-area span {
  background-color: transparent;
  color: #4f5d77;
  letter-spacing: 2px;
}

.pagination li {
    border: 0;
  padding: 0 10px;
  -webkit-box-shadow: none;
  box-shadow: none;
  outline: 0;
  /* width: 34px; */
  height: 34px;
  display: block;
  border-radius: 4px;
  color: #696969;
  line-height: 34px;
  text-align: center;
  font-weight: 700;
}
.product-cart-wrap:hover .product-action-1 .active-wishlist{
    background-color: #cd4040;
    border: 1px solid transparent;
    color: #fff;
}
.product-cart-wrap{
    border: none;
}
/* Modal Css */
.modal-target {
  width: 300px;
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

.modal-target:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  /* z-index: 1; */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.8); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-contents {
  margin: auto;
  display: block;
  width: 80%;
  opacity: 1 !important;
  max-width: 1200px;
  height: 95%;
  object-fit: contain;
}

/* Caption of Modal Image */
.modal-caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 1200px;
  text-align: center;
  color: white;
  font-weight: 700;
  font-size: 1em;
  margin-top: 32px;
}

/* Add Animation */
.modal-contents, .modal-caption {
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-atransform:scale(0)}
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

/* The Close Button */
.modal-close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.modal-close:hover,
.modal-close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

@media only screen and (max-width: 766px) {
    .product-cart-wrap .product-img-action-wrap .product-img{
        height: 232px !important;
    }
    .product-cart-wrap .product-img-action-wrap .product-img a img.highlight{
        height: 238px !important;
    }
    *,::after,::before {
        box-sizing: border-box;
    }
}
</style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ route('user.dashboard') }}" rel="nofollow">Home</a>
                    <span></span> <a href="#" rel="nofollow">Highlights</a>
                    <span></span> Images
                </div>
            </div>
        </div>
        <section class="full_width_background" style="position: relative">
            <div class="bg-square1"></div>
            <div class="container pt-50 pb-50">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-product-fillter">
                            <div class="tab-header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">Images</button>
                                    </li>
                                                            <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three" onclick="location.href='{{route('customerHighlights.videos')}}'" type="button" aria-controls="tab-three" aria-selected="false">Videos</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="row product-grid-3 all_images">
                            @if (count($image_highlight) > 0)
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
                            @else
                            <div class="col-lg-4 col-md-4">
                            </div>
                            <div class="col-lg-3 col-md-4">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-content-wrap">
                                        <h2 class="mt-3" style="text-align: center;"><a href="#">Image Highlights Not Found</a></h2>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!--pagination-->
                        @if (count($image_highlight) > 0)
                        <input type="hidden" class="pagenum" value="{{$image_highlight->currentPage()  + 1}}" />
                        <div class="lode_more_loader" style="text-align: -webkit-center;">
                            <div class="loader">
                                <div class="bar bar1"></div>
                                <div class="bar bar2"></div>
                                <div class="bar bar3"></div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
        <div id="modal" class="modal">
            <span id="modal-close" class="modal-close">&times;</span>
            <img id="modal-content" class="modal-contents">
            <div id="modal-caption" class="modal-caption"></div>
          </div>
    </main>
@endsection

@section('page-script')
<script  async>
    $(window).scroll(function() {
       if ($(window).scrollTop() + $(window).height() + 600 >= $(document).height()) {
           var page = parseInt($('.pagenum').val());
           if (page != 0 || page != '0') {
               loadMoreOrder(page);
           }
       }
   });

   function loadMoreOrder(pagenum) {
        var base_url = config.data.base_url;
       if (!jQuery(document).find('.lode_more_loader').hasClass('ajax-running')) {
           $('.pagenum').val(pagenum + 1);
           $.ajax({
                   url: base_url + '/highlights/images?page=' + pagenum,
                   type: "get",
                   datatype: 'html',
                   beforeSend: function() {
                       jQuery(document).find('.lode_more_loader').addClass('ajax-running');
                       $('.load-more-btn').text('Loading....');
                       $('.lode_more_loader').show();
                   }
               })
               .done(function(data) {
                   if (data.html.length == 0) {
                       $('.invisible').removeClass('invisible');
                       $('.pagenum').val(0)
                       $('.lode_more_loader').hide();
                       return false;
                   } else {
                       $('.load-more-btn').text('Load more...');
                       $('.all_images').append(data.html);
                       $('.lode_more_loader').hide();
                   }
                   jQuery(document).find('.lode_more_loader').removeClass('ajax-running');
               })
               .fail(function(jqXHR, ajaxOptions, thrownError) {
                   $('.lode_more_loader').hide();
                   $('.pagenum').val(0);
                   jQuery(document).find('.lode_more_loader').removeClass('ajax-running');
                   return false;
               });
       }
   }
</script>
<script  async>
// Modal Setup
var modal = document.getElementById('modal');

var modalClose = document.getElementById('modal-close');
modalClose.addEventListener('click', function() {
  modal.style.display = "none";
});

// global handler
document.addEventListener('click', function (e) {
  if (e.target.className.indexOf('modal-target') !== -1) {
      var img = e.target;
      var modalImg = document.getElementById("modal-content");
      var captionText = document.getElementById("modal-caption");
      modal.style.display = "block";
      modalImg.src = img.src;
      captionText.innerHTML = img.alt;
   }
});

</script>
@endsection

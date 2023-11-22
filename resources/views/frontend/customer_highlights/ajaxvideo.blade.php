@foreach ($video_highlight as $video_highlights)
<div class="swiper-wrapper" style="display: flex;">
    <div class=" -visible -active"
        style="width: 195.03px;">
        <div class="whatmore-event-tile-scale-in-animation"
            style="margin-left: 4px; margin-right: 4px; width: 177px; height: 325px; border-radius: 5px; box-shadow: rgb(176, 176, 176) 0px 0px 10px 3px; border-width: 0px; border-color: white; overflow: hidden; cursor: pointer; margin-top: 25px !important; margin-bottom: 25px !important;">
            <div style="width: 100%; height: 100%; overflow: hidden;">
                <video
                    class="whatmore-video-player modal-target" width="100%" height="100%"
                    preload="auto" loop="" playsinline=""
                    src="{{ URL::asset('public/images/highlights/videos/'.$video_highlights->path)}}"
                    style="background-color: white;" autoplay muted>
                </video>
                </div>
        </div>
    </div>
</div>
@endforeach

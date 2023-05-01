               
<div class="row d-flex justify-content-left">
@foreach($array as $games)
    <div class="col-2" style="padding:15px">
        <div class="image-container">
            <img src="https://files.sitestatic.net/aurin_image/demo_assets/spadegaming/slots/{{$games['image_name']}}" style="width:100%" alt="slots-in-malaysia">
            <div class="overlay">
                <a href="{{url('launchSG')}}/{{$games['game_code']}}" target="_blank" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
            </div>
        </div>
    </div>
@endforeach
</div>

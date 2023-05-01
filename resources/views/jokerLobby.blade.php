
<div class="row d-flex justify-content-left">
@foreach($gameLists as $games)
    <div class="col-2" style="padding:5px">
        <div class="image-container">
            <img src="{{$games['Image1']}}" class="img-fluid" alt="slots-in-malaysia">
            <div class="overlay">
                <a href="{{url('launchJokerTransferGame')}}/{{$games['GameCode']}}" target="_blank" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
            </div>
        </div>
    </div>
@endforeach
</div>

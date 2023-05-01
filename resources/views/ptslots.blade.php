
<div class="row d-flex justify-content-left">
@foreach($array as $games)
    <div class="col-2" style="padding:5px">
        <div class="image-container">
            <img src="{{$games['image_path']}}" class="img-fluid" alt="slots-in-malaysia">
            <div class="overlay">
                <a href="{{url('playtechLobby')}}?username={{$games['user_name']}}&client=ngm_desktop&mode=real&game_code={{$games['game_code']}}&password={{$games['password']}}" target="_blank" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
            </div>
        </div>
    </div>
@endforeach
</div>


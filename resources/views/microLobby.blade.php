<div class="row d-flex justify-content-left">

@foreach($gameArray as $g)
    @if($g['name'] == 'Aces & Faces - 10 Play Power Poker' || 
        $g['name'] == 'Aces & Faces Power Poker' ||
        $g['name'] == 'Hidden Palace Treasures' ||
        $g['name'] == 'Liquid Gold' ||
        $g['name'] == 'Pho Win' ||
        $g['name'] == 'The Golden Mask Dance' ||
        $g['name'] == 'Agent Jane Blonde Returns' ||
        $g['name'] == 'All Aces - 10 Play Power Poker' ||
        $g['name'] == 'American Roulette (Jade)' ||
        $g['name'] == 'Atlantic City Blackjack (Jade)' ||
        $g['name'] == 'Baccarat (Jade)' ||
        $g['name'] == 'Boogie Monsters' ||
        $g['name'] == 'Bookie of Odds' ||
        $g['name'] == 'Classic Blackjack (Jade)' ||
        $g['name'] == 'Cuoi and the Banyan Tree' ||
        $g['name'] == 'Deuces & Joker - 10 Play Power Poker' ||
        $g['name'] == 'Deuces & Joker - Power Poker' ||
        $g['name'] == 'Deuces Wild - 10 Play Power Poker' ||
        $g['name'] == 'Deuces Wild - Power Poker' ||
        $g['name'] == 'Diamond Empire' ||
        $g['name'] == 'Double Double Bonus - 10 Play Power Poker' ||
        $g['name'] == 'Double Double Bonus - Power Poker' ||
        $g['name'] == 'Dream Date' ||
        $g['name'] == 'European Blackjack (Jade)' ||
        $g['name'] == 'European Roulette (Jade)' ||
        $g['name'] == 'Fortune Finder with Holly' ||
        $g['name'] == 'Fortune Finder with Sarati' ||
        $g['name'] == 'Gold Factory' ||
        $g['name'] == 'Hollywood Baccarat' ||
        $g['name'] == 'Jacks or Better - Power Poker' ||
        $g['name'] == 'Lucky Silat' ||
        $g['name'] == 'Lucky Thai Lanterns' ||
        $g['name'] == 'Makan Makan' ||
        $g['name'] == 'Mega Money Rush' ||
        $g['name'] == 'Real Baccarat with Courtney™' ||
        $g['name'] == 'Real Baccarat with Holly™' ||
        $g['name'] == 'Real Baccarat with Sarati™' ||
        $g['name'] == 'Real Roulette with Bailey™' ||
        $g['name'] == 'Real Roulette with Caroline™' ||
        $g['name'] == 'Real Roulette with Holly™' ||
        $g['name'] == 'Real Roulette with Sarati™' ||
        $g['name'] == 'Secrets of Sengoku' ||
        $g['name'] == 'Shogun of Time' ||
        $g['name'] == 'Showdown Saloon' ||
        $g['name'] == 'Sisters of Oz: Jackpots' ||
        $g['name'] == 'The Gold Swallow' ||
        $g['name'] == 'The Great Albini' ||
        $g['name'] == 'Tomb Raider Secret of the Sword' ||
        $g['name'] == 'Vegas Downtown Blackjack (Jade)' ||
        $g['name'] == 'Vegas Single Deck Blackjack (Jade)' ||
        $g['name'] == 'Vegas Strip Blackjack (Jade)' ||
        $g['name'] == 'The Immortal Sumo' ||
        $g['name'] == 'Zombie Hoard'
    )
    
    @else
    
    <div class="col-2" style="padding:5px">
        <div class="image-container">
            <img src="https://www.me88safes.com/public/html/games/images/s1/MGP/{{$g['gameCode']}}.jpg" class="img-fluid" alt="slots-in-malaysia">
            <div class="overlay">
                <a href="{{url('mg/sessionslot')}}/{{$g['gameCode']}}" target="_blank" class="play-button"><button class="btn btn-sm btn-primary" style="background-color:#640a74;width:100px">PLAY</button></a>
            </div>
            <!--<h3>{{$g['name']}}</h3>-->
        </div>
    </div>


    @endif
@endforeach
</div>
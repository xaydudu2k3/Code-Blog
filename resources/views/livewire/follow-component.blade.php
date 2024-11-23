<button class="btn  btn-sm m-2 {{$IFollowed == true ? 'btn-primary' : 'btn-outline-primary'}}" wire:click.prevent="followUnfollow({{$followed_id}})"> follow {{$number_followers}}</button>

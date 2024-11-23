<div>
    @if (!auth()->check())
    <button class="btn btn-outline-primary btn-sm m-2"
        style="cursor: pointer;"
        onclick="checkLoginStatus(event)">
        follow {{$number_followers}}
    </button>
    @else
    <button class="btn btn-outline-primary btn-sm m-2"
        style="cursor: pointer;"
        wire:click.prevent="followUnfollow({{$followed_id}})">
        {{$IFollowed ? 'unfollow' : 'follow'}} {{$number_followers}}
    </button>
    @endif
</div>

<script>
    function checkLoginStatus(event) {
        alert("You must login to perform this action");
    }
</script>
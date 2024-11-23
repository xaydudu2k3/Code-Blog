<div class="col-xl-6">
    <livewire:post-viewers-count :postId="$post_id" />

    @if (!auth()->check())
    <i class="bi bi-hand-thumbs-up float-end"
        style="cursor: pointer;"
        onclick="checkLoginStatus(event)">
    </i>
    <span class="text-muted float-end mx-2">{{$likesCount}}</span>
    @else
    @if ($isLiked == false)
    <i class="bi bi-hand-thumbs-up float-end"
        style="cursor: pointer;"
        wire:click.prevent="likeUnlike">
    </i>
    <span class="text-muted float-end mx-2">{{$likesCount}}</span>
    @else
    <i class="bi bi-hand-thumbs-up-fill float-end"
        style="cursor: pointer;"
        wire:click.prevent="likeUnlike">
    </i>
    <span class="text-muted float-end mx-2">{{$likesCount}}</span>
    @endif
    @endif
</div>

<script>
    function checkLoginStatus(event) {
        alert("You must login to perform this action");
    }
</script>
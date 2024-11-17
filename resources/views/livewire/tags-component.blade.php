<div class="tags-container">
    @foreach($tags as $tag)
        <span class="badge bg-info text-dark me-2">
            <i class="fa fa-tag"></i> {{ $tag }}
        </span>
    @endforeach
</div>

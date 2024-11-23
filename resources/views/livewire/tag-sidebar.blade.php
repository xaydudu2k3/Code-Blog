<ul id="tables-nav" class="nav-content collapse show" data-bs-parent="#sidebar-nav">
    @foreach ($tags as $tag)
        <li>
            <a href="{{ request()->is('trending') ? '/trending/' . $tag->id : '/home/tag/' . $tag->id }}" wire:navigate>
                <i class="bi bi-circle"></i><span>{{ $tag->name }}</span>
            </a>
        </li>
    @endforeach
</ul>
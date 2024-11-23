@extends('layouts/user-layout')
@section('space-work')
<div class="container">
    <livewire:user-trending :tag_id="$tag_id"/>
</div>
@endsection
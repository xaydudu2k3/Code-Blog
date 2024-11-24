@extends('layouts/user-layout')
@section('space-work')
<div class="container">
    <livewire:guest-posts :user_id="$userId" />
</div>
@endsection
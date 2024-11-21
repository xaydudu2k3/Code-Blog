@extends('layouts/admin-layout')
@section('space-work')
<div class="container">
    <livewire:guest-posts :user_id="$user_id" />
</div>
@endsection
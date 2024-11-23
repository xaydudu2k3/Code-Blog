@extends('layouts/admin-layout')
@section('space-work')
<div class="container">
    <livewire:like-posts :userId="$user_id" /> 
</div>

@endsection
@extends('layouts/user-layout')
@section('space-work')
<div class="container">
    <livewire:like-posts :userId="$userId" /> 
</div>

@endsection
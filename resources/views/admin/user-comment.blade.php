@extends('layouts/admin-layout')
@section('space-work')
<div class="container">
    <livewire:user-comment :userId="$userId" /> 
</div>

@endsection
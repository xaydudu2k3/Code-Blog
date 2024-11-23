@extends('layouts/admin-layout')
@section('space-work')
<div class="container">
    <livewire:user-following :userId="$userId" /> 
</div>

@endsection
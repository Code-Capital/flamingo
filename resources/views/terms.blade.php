@extends('layouts.app')
@section('title', 'Terms & Conditions')
@section('styles')
@endsection
@section('content')
    <div class="termsWrapper py-5">
        <div class="container">
            {!! htmlspecialchars_decode($terms->content) !!}
        </div>
    </div>
@endsection

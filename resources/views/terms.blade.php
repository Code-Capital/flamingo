@extends('layouts.app')
@section('title', 'Terms & Conditions')
@section('styles')
@endsection
@section('content')
    <div class="termsWrapper py-5">
        <div class="container">
            @if (!empty($terms->content))
                {!! htmlspecialchars_decode($terms->content) !!}
            @endif
        </div>
    </div>
@endsection

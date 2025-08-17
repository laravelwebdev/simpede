@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))
@php
    $inspiration = Laravelwebdev\NovaQuotes\Inspiring\Inspiring::show();
@endphp

@section('quote', $inspiration['quote'])
@section('author', $inspiration['author'])

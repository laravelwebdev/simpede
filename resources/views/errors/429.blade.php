@extends('errors::minimal')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('Too Many Requests'))
@php
    $inspiration = Laravelwebdev\NovaQuotes\Inspiring\Inspiring::show();
@endphp

@section('quote', $inspiration['quote'])
@section('author', $inspiration['author'])

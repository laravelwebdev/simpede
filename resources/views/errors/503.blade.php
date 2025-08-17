@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __('Service Unavailable'))
@php
    $inspiration = Laravelwebdev\NovaQuotes\Inspiring\Inspiring::show();
@endphp

@section('quote', $inspiration['quote'])
@section('author', $inspiration['author'])

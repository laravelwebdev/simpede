@extends('errors::minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
@php
    $inspiration = Laravelwebdev\NovaQuotes\Inspiring\Inspiring::show();
@endphp

@section('quote', $inspiration['quote'])
@section('author', $inspiration['author'])

@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
@php
    $inspiration = Laravelwebdev\NovaQuotes\Inspiring\Inspiring::show();
@endphp

@section('quote', $inspiration['quote'])
@section('author', $inspiration['author'])

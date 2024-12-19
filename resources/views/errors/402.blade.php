@extends('errors::minimal')

@section('title', __('Payment Required'))
@section('code', '402')
@section('message', __('Payment Required'))
@section('quote', \App\Helpers\Inspiring::show())
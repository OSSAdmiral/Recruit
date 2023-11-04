@extends('errors::minimal')

@section('title', __(''))
@section('code', '410')
@section('message', __($exception->getMessage() ?: 'Forbidden'))

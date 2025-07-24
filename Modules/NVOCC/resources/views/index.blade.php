@extends('core::dashboard.layouts.master')
@section('title', 'NVOCC')

@section('content')
    @include('nvocc::layouts.tabs_master', [
        'tabContents' => collect([
            'nvocc::tabs.find',
            'nvocc::tabs.booking',
            'nvocc::tabs.bl_parties',
            'nvocc::tabs.cgo_cont',
            'nvocc::tabs.charges',
            'nvocc::tabs.psa_an',
            'nvocc::tabs.hbl',
            'nvocc::tabs.notify',
        ])->map(fn($view) => view($view)->render())->implode('')
    ])
@endsection


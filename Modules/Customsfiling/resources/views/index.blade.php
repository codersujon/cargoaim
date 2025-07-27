@extends('core::dashboard.layouts.master')
@section('title', transText('ens_ch'))

@section('content')
    <style>
        .table > :not(caption) > * > * {
            padding: 0!important;
        }

        tr > td, tr > th {
            padding-top: 10px;
            padding-bottom: 10px;
        }

        #customerModal.modal.show {
            z-index: 1060 !important;
        }

        .modal-backdrop.show:nth-of-type(2) {
            z-index: 1055 !important;
        }
        .ics2_ens_card{
            max-height: auto !important;
            padding-bottom: 20px!important;
        }
    </style>

    {{-- Load ENS Data --}}
    @include('customsfiling::euens.load_data')

    {{-- ICS ENS Modal --}}
    @include('customsfiling::euens.ics_ens_modal')

    {{-- Customer Modal --}}
    @include('customsfiling::euens.customer_modal')

@endsection



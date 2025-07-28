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
        .ics_ens_display {
            width: 96.15%;
            position: fixed;
            padding-left: 8px;
            /* margin-top: 10px; */
        }
        .ics2_ens_card{
            max-height: auto !important;
            padding-bottom: 20px!important;
            margin-top: 10px;
            border: 1px solid #d9d9d9;
        }
        
    </style>

    {{-- Load ENS Data --}}
    @include('customsfiling::euens.load_data')

    {{-- ICS ENS Modal --}}
    @include('customsfiling::euens.ics_ens_modal')

    {{-- Customer Modal --}}
    @include('customsfiling::euens.customer_modal')

@endsection



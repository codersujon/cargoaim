@extends('core::dashboard.layouts.master')

@section('title', "| {{ transText('profile') }}")

@section('content')
    <div class="row pt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header border-bottom border-dashed">
                    <h4 class="card-title mb-0 flex-grow-1">{{ transText('profile') }}</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th> {{ transText('name_th') }}: </th>
                                    <td>{{ $data->name ?? '' }}</td>

                                     <th> {{ transText('contactno_th') }}: </th>
                                    <td>{{ $data->contact ?? ''}}</td>                                   
                                </tr>
                                
                                <tr>
                                    <th> {{ transText('faveicon_th') }}: </th>
                                    <td>
                                        <img alt="image" src="{{ asset('upload/' . ($data?->fav_icon ?? 'default.png')) }}" width="45">
                                    </td>

                                    <th> {{ transText('logo_th') }}: </th>
                                    <td>
                                        <img alt="image" src="{{ asset('upload/' . ($data?->logo ?? 'default.png')) }}" width="45">
                                    </td>                            
                                </tr>
                                <tr>
                                    <th> {{ transText('email_th') }}: </th>
                                    <td>{{ $data->email ?? ''}}</td>

                                    <th>{{ transText('address_th') }}: </th>
                                    <td>{{ $data->address ?? ''}}</td>
                                </tr>                                
                                                           
                                <tr>
                                    <th>{{ transText('location_th') }}:</th>
                                    <td style="word-break: break-word; max-width: 300px; padding: 5px;">
                                        {{ $data->location ?? ''}}
                                    </td>

                                    <th>{{ transText('copyright_th') }}:</th>
                                    <td>{{ $data->copyright ?? ''}}</td>
                                </tr>

                                
                                <tr>
                                    <td colspan="4" class="text-center pt-4">
                                        <button type="button" id="edit" data-id="{{ $data?->id }}" class="btn btn-primary">
                                            <i class="ti ti-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

    <!-- The Modal -->
    <div class="modal fade" id="bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body">
                    <form id="form" name="form" class="form-horizontal" method="POST" action="{{ url('profile') }}" enctype="multipart/form-data">
                        @csrf()

                        <div class="table-responsive border border-2 rounded">
                            <table class="table table-borderless mt-1 table_not_caption">
                                <tbody class="mx-2">
                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <input type="hidden" name="id" id="id">

                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('name_th') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="" required autocomplete="off" style="margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('email_th') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="email" class="form-control" required name="email" id="email" placeholder="" autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('contactno_th') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="number" class="form-control" required name="contact" id="contact" placeholder="" autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('logo_th') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="file" class="form-control" name="logo" id="logo" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('faveicon_th') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="file" class="form-control" name="fav_icon" id="fav_icon" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('address_th') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="text" class="form-control" name="address" id="address" placeholder="" autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('location_th') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <textarea name="location" id="location" cols="30" rows="2" class="form-control" placeholder="" autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;"></textarea>
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('copyright_th') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="text" name="copyright" id="copyright" class="form-control" placeholder="" autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="text-end col-sm-offset-2 col-sm-12 my-1 px-1">
                                <button type="button" class="btn btn-success" id="close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    {{ transText('close_btn') }}
                                </button>
                                <button type="submit" class="btn btn-primary" id="saveBtn">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- The Modal End-->
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            /*------------------Click to Edit Button------------------*/
           // ✅ Edit button handling
            $('body').on('click', '#edit', function () {
                var id = $(this).data('id');
                var edit = '{{ transText("edit") }}';
                var update = '{{ transText("update_btn") }}';

                $.get("{{ route('profile.index') }}/" + id + "/edit", function (data) {
                    $('#myLargeModalLabel').html(edit);
                    $('#saveBtn').html(update);
                    $('#bs-example-modal-lg').modal('show');

                    // Populate fields
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#contact').val(data.contact);
                    $('#other_contact').val(data.other_contact);
                    $('#address').val(data.address);
                    $('#fb_link').val(data.fb_link);
                    $('#whatsapp_link').val(data.whatsapp_link);
                    $('#twiter_link').val(data.twiter_link);
                    $('#instra_link').val(data.instra_link);
                    $('#youTube_link').val(data.youTube_link);
                    $('#telegram_link').val(data.telegram_link);
                    $('#viber_link').val(data.viber_link);
                    $('#botim_link').val(data.botim_link);
                    $('#location').val(data.location);
                    $('#message').val(data.message);
                    $('#copyright').val(data.copyright);

                });
            });


            $('#close').click(function() {
                $('#ajaxModel').modal('hide');

            });


            $('#location').on('input', function() {
                var embedCode = $(this).val();
                var match = embedCode.match(/src="([^"]+)"/);
                if (match && match[1]) {
                    $(this).val(match[1]);
                }
            });
        });
    </script>
@endsection

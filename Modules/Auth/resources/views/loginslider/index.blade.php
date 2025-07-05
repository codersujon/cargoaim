@extends('core::dashboard.layouts.master')

@section('title', "| {{ transText('login_page_slider_ch') }}")

@section('content')
    <div class="row pt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped display" id="myTable">
                            <thead>
                                <tr>
                                    <th>{{ transText('sn_th') }}</th>
                                    <th>{{ transText('title_th') }}</th>
                                    <th>{{ transText('description_th') }}</th>
                                    <th>{{ transText('status_th') }}</th>
                                    <th class="text-center">{{ transText('action_th') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <!-- Switch-->
                                            <div>
                                                <input type="checkbox" id="customSwitchStatus{{ $item->id }}" data-id="{{ $item->id }}"
                                                    {{ $item->status == 'A' ? 'checked' : '' }} data-switch="success" class="toggle-status" />
                                                <label for="customSwitchStatus{{ $item->id }}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <button type="button" id="edit" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-info me-2">
                                                    <i class="ti ti-edit"></i>
                                                </button>
                                                <button type="button" id="delete" data-id="{{ $item->id }}"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
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
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form" name="form" class="form-horizontal" method="POST"
                        action="{{ url('login_page_slider') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <input type="hidden" name="id" id="id">

                            <div class="mb-2">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon1">{{ transText('title_label') }}</span>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="{{ transText('title_placeholder') }}" required>
                                </div>                                
                            </div>

                            <div class="mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('description_label') }}</span>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control"
                                        placeholder="{{ transText('description_placeholder') }}"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="text-end col-sm-offset-2 col-sm-12 mt-2">
                            <button type="button" class="btn btn-success" id="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                {{ transText('close_btn') }}
                            </button>
                            <button type="submit" class="btn btn-primary" id="saveBtn"></button>
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
            $('#myTable').on('draw.dt', function() {
                // Language label যোগ করা
                if ($('.language-manage-label').length === 0) {
                    var languageLabel = @json(transText('login_page_slider_ch'));
                    $('.dt-length').before('<span class="language-manage-label" style="margin-right: 10px; font-weight: bold;">' + languageLabel + '</span>');
                }

                // Add button যোগ করা
                if ($('#createNew1').length === 0) {
                    var addButton = `<button class="btn btn-primary ms-2" href="javascript:void(0)" id="createNew1"><i class="ti ti-plus"></i> {{ transText('add_new_btn') }}</button>`;
                    $('.dt-search').after(addButton);
                }
            });

            // Event delegation দিয়ে click handler
            $(document).on('click', '#createNew1', function () {
                var save = '{{ transText("save_btn") }}';
                var createNew = '{{ transText("create_new") }}';
                showModalForCreateNew(save, createNew);
            });

            /*------------------Click to Edit Button------------------*/
            // Edit Button Click
            loadEditDataToModal(
                '#edit',
                "{{ route('login_page_slider.index') }}",
                '#bs-example-modal-lg',
                [
                    { selector: '#id', key: 'id' },
                    { selector: '#title', key: 'title' },
                    { selector: '#description', key: 'description' },                   
                ],
                '{{ transText("edit") }}',
                '{{ transText("update_btn") }}'
            );

            $('body').on('click', '#delete', function() {
                var id = $(this).data("id");
                Swal.fire(sweetAlertConfirmation).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: 'login_page_slider/' + id,
                            success: function(data) {
                                window.location = 'login_page_slider';
                                const Toast = Swal.mixin(toastConfiguration);
                                Toast.fire({
                                    icon: "success",
                                    title: "Deleted Successfully!!!"
                                });
                            }
                        });
                    }
                });
                return false;
            });

            $('#close').click(function() {
                $('#ajaxModel').modal('hide');
            });




            $('body').on('change', '.toggle-status', function () {
                var id = $(this).data('id');
                var newStatus = $(this).is(':checked') ? 'A' : 'I'; // A = Active, I = Inactive

                $.ajax({
                    type: "POST",
                    url: "{{ route('active.status') }}",
                    data: {
                        id: id,
                        status: newStatus,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        Toast.fire({
                            icon: 'success',
                            title: newStatus === 'A' ? 'Activated successfully!' : 'Deactivated successfully!'
                        });
                    },
                    error: function (xhr) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong! Please try again later.",
                        });
                    }
                });
            });




        });
    </script>
@endsection

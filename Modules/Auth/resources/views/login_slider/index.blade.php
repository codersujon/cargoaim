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
                            <tbody id="dataBody">
                                
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

                        <div class="table-responsive border border-2 rounded">
                            <table class="table table-borderless mt-1 table_not_caption">
                                <tbody class="mx-2">
                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <input type="hidden" name="id" id="id">

                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('title_label') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ transText('title_placeholder') }}" required autocomplete="off" style="margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('description_label') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <textarea name="description" id="description" cols="30" rows="2" class="form-control" placeholder="{{ transText('description_placeholder') }}" autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;"></textarea>
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
            $('#myTable').on('draw.dt', function() {
                // Card Header যোগ করা
                if ($('.table_details').length === 0) {
                    var cardHeader = @json(transText('login_page_slider_ch'));
                    $('.dt-length').before('<span class="table_details" style="margin-right: 10px; font-weight: bold;">' + cardHeader + '</span>');
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

            const dataRowTemplate = (item, index) => `
                <tr>
                    <td>${index}</td>
                    <td>${item.title ?? ''}</td>
                    <td>${item.description ?? ''}</td>
                    <td>
                        <div>
                            <input type="checkbox" id="customSwitchStatus${item.id}" data-id="${item.id}"
                                ${item.status === 'A' ? 'checked' : ''} class="toggle-status" data-switch="success" />
                            <label for="customSwitchStatus${item.id}" data-on-label="Yes" data-off-label="No" class="mb-0 d-block"></label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center">
                            <button type="button" id="edit" data-id="${item.id}" class="btn btn-sm btn-info me-2">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button type="button" id="delete" data-id="${item.id}" class="btn btn-sm btn-danger">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>`;

            const reloadTable = () => loadTableData({
                url: "{{ url('lps_fetch') }}",
                tableId: 'myTable',
                tableBodyId: 'dataBody',
                rowTemplate: dataRowTemplate
            });

            reloadTable();

            submitFormWithAjax('#form', "{{ url('login_page_slider') }}", reloadTable);

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
                '{{ transText("update_btn") }}',
            );


            

            /*------------------Click to Delete Button------------------*/
            // Delete Button Click
            handleDelete('#delete', 'login_page_slider', reloadTable);

            // Modal Close
            $('#close').click(function() {
                $('#ajaxModel').modal('hide');
            });


            
            //----- Data Active and Inactive ------/////
            $('body').on('change', '.toggle-status', function () {
                const id = $(this).data('id');
                const status = $(this).is(':checked') ? 'A' : 'I';
                const url = "{{ route('active.status') }}";

                toggleStatusUpdate(id, status, url);
            });



        });
    </script>
@endsection

@extends('core::dashboard.layouts.master')
@section('title', "| Menu Management")

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
                                    <th>{{ transText('name_route_th') }}</th>
                                    <th>{{ transText('parent_id_th') }}</th>
                                    <th>{{ transText('order_th') }}</th>
                                    <th>{{ transText('status_th') }}</th>
                                    <th>{{ transText('module_name_th') }}</th>
                                    <th>{{ transText('remarks_th') }} </th>
                                    <th>{{ transText('action_th') }} </th>
                                </tr>
                            </thead>
                            <tbody id="dataBody">
                                <!-- Data will be dynamically inserted here -->
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
                        action="{{ url('language') }}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                            <input type="hidden" name="row_id" id="row_id">

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="input-group flex-nowrap">
                                    <span class="input-group-text" id="basic-addon1">{{ transText('type_label') }}</span>
                                    <input type="text" name="apply_on_type" id="apply_on_type" class="form-control" placeholder="{{ transText('type_placeholder') }}" required autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('message_label') }}</span>
                                    <input type="text" name="message_id_to_call" id="message_id_to_call" class="form-control" placeholder="{{ transText('message_placeholder') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('en_label') }} </span>
                                    <input type="text" name="en" id="en" class="form-control" placeholder="{{ transText('en_placeholder') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('bn_label') }}</span>
                                    <input type="text" name="bn" id="bn" class="form-control" placeholder="{{ transText('bn_placeholder') }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('cn_label') }} </span>
                                    <input type="text" name="cn" id="cn" class="form-control" placeholder="{{ transText('cn_placeholder') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('tn_label') }}  </span>
                                    <input type="text" name="th" id="th" class="form-control" placeholder="{{ transText('tn_placeholder') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('vn_label') }} </span>
                                    <input type="text" name="vn" id="vn" class="form-control" placeholder="{{ transText('vn_placeholder') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('kn_label') }} </span>
                                    <input type="text" name="kh" id="kh" class="form-control" placeholder="{{ transText('kn_placeholder') }}" autocomplete="off">
                                </div>
                            </div>                            
                            <div class="col-sm-12 col-md-12 col-lg-12 mb-2">
                                <div class="input-group">
                                    <span class="input-group-text">{{ transText('remarks_label') }} </span>
                                    <input type="text" name="remarks" id="remarks" class="form-control" placeholder="{{ transText('remarks_placeholder') }}" autocomplete="off">
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
        $(document).ready(function () {

            $('#myTable').on('draw.dt', function() {
                // Language label যোগ করা
                if ($('.language-manage-label').length === 0) {
                    var languageLabel = @json(transText('language_ch'));
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


            // Load Table Data Function
            function loadTableData() {
                $.get("{{ url('language_fetch') }}", function (data) {
                    let html = '';
                    let i = 1;
                    data.forEach(function (item) {
                        html += `<tr>
                                    <td>${i++}</td>
                                    <td>${item.apply_on_type}</td>
                                    <td>${item.message_id_to_call}</td>
                                    <td>${item.en ?? ''}</td>
                                    <td>${item.bn ?? ''}</td>
                                    <td>${item.cn ?? ''}</td>
                                    <td>${item.th ?? ''}</td>
                                    <td>${item.remarks ?? ''}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <button type="button" id="edit" data-id="${item.row_id}" class="btn btn-sm btn-info me-2"><i class="ti ti-edit"></i></button>
                                        </div>
                                    </td>
                                </tr>`;
                    });
                    $('#myTable').DataTable().destroy(); // destroy old
                    $('#dataBody').html(html); // insert new
                    $('#myTable').DataTable(); // reinitialize
                });
            }
            // Initial load
            loadTableData();

            // Form Submit
            submitFormWithAjax('#form', "{{ url('language') }}", loadTableData);

            // Edit Button Click
            loadEditDataToModal(
                '#edit',
                "{{ route('language.index') }}",
                '#bs-example-modal-lg',
                [
                    { selector: '#row_id', key: 'row_id' },
                    { selector: '#apply_on_type', key: 'apply_on_type' },
                    { selector: '#message_id_to_call', key: 'message_id_to_call' },
                    { selector: '#en', key: 'en' },
                    { selector: '#bn', key: 'bn' },
                    { selector: '#cn', key: 'cn' },
                    { selector: '#th', key: 'th' },
                    { selector: '#vn', key: 'vn' },
                    { selector: '#kh', key: 'kh' },
                    { selector: '#remarks', key: 'remarks' }
                ],
                '{{ transText("edit") }}',
                '{{ transText("update_btn") }}',
                function () {
                    // callback after data is loaded
                    $('#message_id_to_call').prop('readonly', true); // make it read-only during edit
                }
            );
            
            // ✅ Edit বাটনে ক্লিক করার সময় message_id_to_call কে read-only করে দিচ্ছে
            $(document).on('click', '#edit', function () {
                setTimeout(function () {
                    $('#message_id_to_call').prop('readonly', true);
                }, 300); // delay দিয়ে wait করানো হচ্ছে যেন modal open হয়
            });

            // Delete Button Click
            handleDeleteAction(
                '#delete',
                "{{ url('language') }}",
                loadTableData,
                {
                    confirmTitle: 'Are you sure?',
                    confirmText: 'You want to delete this item?',
                    confirmBtnText: 'Yes, delete it!',
                    successMessage: 'Deleted Successfully!',
                    errorMessage: 'Something went wrong!'
                }
            );
        });
    </script>
@endsection

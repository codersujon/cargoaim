
<!-- Customer Modal Start -->
<div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
    <div class="modal-dialog"> <!-- এখানে modal-sm দিয়ে ছোট মডাল -->
        <div class="modal-content custom-modal-content">
            <div class="modal-body">
                <!-- আপনার মডালের কন্টেন্ট এখানে দিবেন -->
                <form id="customer_form" name="form" class="form-horizontal" method="POST"
                    action="{{ url('customer_address') }}" enctype="multipart/form-data">
                    @csrf()

                        <div class="table-responsive border border-2 rounded">
                            <table class="table table-borderless mt-1">
                                <tbody class="mx-2">
                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('name_lable') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="text" name="customer_full_name" id="customer_full_name" class="form-control" placeholder="{{ transText('pno_placeholder') }}" required autocomplete="off" style="margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>
                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('country_placeholder') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <select class="form-select" name="customerAddressCountry" id="customerAddressCountry" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                                <option value="">Loading...</option>
                                            </select>
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('city_placeholder') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <select class="form-select" name="address_city" id="address_city" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                                <option value=""></option>
                                            </select>
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('postal_zip_placeholder') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                                <input type="text" name="address_zip" id="address_zip" class="form-control" placeholder="{{ transText('postal_zip_placeholder') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('address_lable') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="text" name="customerAddress" id="customerAddress" class="form-control" placeholder="{{ transText('address_lable') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('lic_bin_eori_lable') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="text" name="customer_address_bin_number" id="customer_address_bin_number" class="form-control" placeholder="{{ transText('license_placeholder') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('phone_placeholder') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                                <input type="text" name="customerAddressPhone" id="customerAddressPhone" class="form-control" placeholder="{{ transText('phone_placeholder') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
                                        </td>
                                        <td style="width: 10px;"></td>
                                    </tr>

                                    <tr class="border-bottom border-dashed">
                                        <th>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span style="margin-left: 10px;">{{ transText('email_lable') }}</span>
                                                <span style="margin-right: 10px;">:</span>
                                            </div>
                                        </th>
                                        <td>
                                            <input type="email" name="customerAddressEmail" id="customerAddressEmail" class="form-control" placeholder="{{ transText('email_placeholder') }}" required autocomplete="off" style="margin-top: 4px; margin-bottom: 4px;">
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
    </div>
</div>
<!-- Customer Modal Start -->

@section('script')
    <script>
        $(document).ready(function () {
            $('#customer_form').on('submit', function (e) {
                e.preventDefault();

                $('.is-invalid').removeClass('is-invalid'); // পুরানো error class clear

                let formData = new FormData(this); // 'this' মানে form DOM

                $.ajax({
                    type: "POST",
                    url: "{{ url('customer_address') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        
                        if (response.status === 'success') {
                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                timer: 1000,
                                showConfirmButton: true
                            });

                            $('#customerModal').modal('hide'); // মডাল বন্ধ
                            $('#customer_form')[0].reset(); // ফর্ম রিসেট

                            // যদি কোনো টেবিল বা ডেটা রিফ্রেশ করতে চান
                            // loadCustomerList();
                        }
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            let errorMsg = "Please correct the following errors:\n\n";
                            $.each(errors, function (key, value) {
                                errorMsg += `- ${value[0]}\n`;
                                $(`#${key}`).addClass('is-invalid');
                            });
                            alert(errorMsg);
                        } else {
                            alert("An unexpected error occurred.");
                        }
                    }
                });
            });
        });
    </script>

   <script>
        $(document).ready(function () {
            // Initialize Bootstrap Modal
            const customerModal = new bootstrap.Modal(document.getElementById('customerModal'), {
                backdrop: 'static',
                keyboard: false
            });

            // Open modal when button clicked
            $(document).on('click', '.open-second-modal', function (e) {
                e.preventDefault();
                customerModal.show();

                // Optional: Adjust z-index if multiple modals used
                setTimeout(() => {
                    const $backdrops = $('.modal-backdrop');
                    if ($backdrops.length > 1) {
                        $backdrops.eq(1).css('z-index', '1055');
                    }
                }, 200);
            });

            // Reset form on modal close (by close button or clicking backdrop)
            $('#customerModal').on('hidden.bs.modal', function () {
                $('#customer_form')[0].reset(); // Reset all inputs
                $('#customerAddressCountry').val('').change(); // Reset select
                $('#address_city').val('').change();
            });

            // Optional: Also reset when "Close" button clicked
            $('#close').click(function () {
                $('#customer_form')[0].reset();
                $('#customerAddressCountry').val('').change();
                $('#address_city').val('').change();
            });
        });
    </script>

@endsection
    // CSRF Token setup for all AJAX requests
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    function showModalForCreateNew(saveText, createNewText) {
        $('#loader').fadeIn();

        setTimeout(function () {
            $('#bs-example-modal-lg').modal('show');
            $('#myLargeModalLabel').text(createNewText);
            $('#form')[0].reset();
            $('#saveBtn').text(saveText);
            $('#row_id').val('');

            $('#loader').fadeOut();
        }, 800);
    }

    ///---- Fetch Data Load ---///
    function loadTableData({ url, tableId = 'myTable', tableBodyId = 'dataBody', rowTemplate }) {
        $.get(url, function (data) {
            let html = '';
            let i = 1;

            data.forEach(function (item) {
                html += rowTemplate(item, i++);
            });

            if ($.fn.DataTable.isDataTable('#' + tableId)) {
                $('#' + tableId).DataTable().destroy();
            }

            $('#' + tableBodyId).html(html);
            $('#' + tableId).DataTable();
        });
    }

    // Form Submit
    function submitFormWithAjax(formSelector, url, reloadCallback) {
        $(formSelector).on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.success) {

                        Swal.fire({
                            text: res.message,
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: true
                        });

                        $('#bs-example-modal-lg').modal('hide');
                        $(formSelector)[0].reset();

                        if (typeof reloadCallback === "function") {
                            reloadCallback(); // Table reload function
                        }
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function (key, value) {
                            errorMessages += `${value[0]}<br>`;
                        });

                        Swal.fire({
                            icon: 'error',
                            title: window.transText.err_val_ttl_msg,
                            html: errorMessages,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: window.transText.err_ttl_msg,
                            text: window.transText.err_msg
                        });
                    }
                }
            });
        });
    }

    // Form Submit 2
    function submitFormWithAjax1(formSelector, url) {
        $(formSelector).on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                contentType: false,
                processData: false,
                success: function (res) {
                    if (res.success) {
                        Swal.fire({
                            text: res.message,
                            icon: "success",
                            timer: 1000,
                            showConfirmButton: true
                        });

                        $('#bs-example-modal-lg').modal('hide');
                        $(formSelector)[0].reset();
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        $.each(errors, function (key, value) {
                            errorMessages += `${value[0]}<br>`;
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: errorMessages,
                        });
                    } else {
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    }
                }
            });
        });
    }

    //---- Edit Data Start----//
    function loadEditDataToModal(editBtnSelector, editUrlPrefix, modalSelector, fieldMappings, modalTitleText, saveBtnText, callback = null) {
        $('body').on('click', editBtnSelector, function () {
            let id = $(this).data('id');
            $('#loader').fadeIn(200);

            $.get(editUrlPrefix + "/" + id + "/edit", function (data) {
                // Modal Title & Button Text
                $(`${modalSelector} .modal-title`).text(modalTitleText);
                $(`${modalSelector} #saveBtn`).text(saveBtnText);

                // Form Fields Fill
                fieldMappings.forEach(function (map) {
                    const value = map.key.includes('.') ? getNestedValue(data, map.key) : data[map.key];
                    $(`${modalSelector} ${map.selector}`).val(value || '');
                });

                // Custom Callback Logic (like dynamic table rendering)
                if (typeof callback === "function") {
                    callback(data);
                }

                $(modalSelector).modal('show');
            })
            .fail(function () {
                alert('ডেটা লোড করতে সমস্যা হয়েছে।');
            })
            .always(function () {
                $('#loader').fadeOut(200);
            });
        });
    }

    // Helper to get nested value like data['main']['row_id']
    function getNestedValue(obj, path) {
        return path.split('.').reduce((o, key) => (o && o[key] !== undefined ? o[key] : ''), obj);
    }
    //--- Edit Data End -----/////


    // Delete Button Click
    function handleDelete(buttonSelector, deleteUrl, reloadCallback, confirmationOptions = null) {
        $('body').on('click', buttonSelector, function () {
            const id = $(this).data("id");

            // যদি custom confirmation options দেয়া না হয়, তাহলে default options
            const defaultConfirmation = {
                title: window.transText.conf_ttl_msg,
                text: window.transText.conf_msg,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: window.transText.conf_yd_btn,
                cancelButtonText: window.transText.cancel_btn,
            };

            const swalOptions = confirmationOptions ?? defaultConfirmation;

            Swal.fire(swalOptions).then((result) => {
                if (result.isConfirmed) {
                    let url = '';
                    if (typeof deleteUrl === 'function') {
                        url = deleteUrl(id); // callback থেকে URL নেয়া
                    } else {
                        url = deleteUrl.endsWith('/') ? deleteUrl + id : deleteUrl + '/' + id; // স্ট্রিং হলে
                    }

                    $.ajax({
                        type: "DELETE",
                        url: url,
                        success: function (data) {
                            Swal.fire({
                                text: data.message,
                                icon: "success",
                                timer: 1000,
                                showConfirmButton: true
                            });

                            if (typeof reloadCallback === 'function') {
                                reloadCallback();
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: window.transText.err_ttl_msg,
                                text: window.transText.err_msg
                            });
                        }
                    });
                }
            });

            return false;
        });
    }
// 


    
    //----- Data Active and Inactive Start------/////
    function toggleStatusUpdate(id, status, url) {
        $.post(url, { id, status })
            .done(() => {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: status === 'A' ? 'Activated!' : 'Deactivated!',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            })
            .fail(() => {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!'
                });
            });
    }
    //----- Data Active and Inactive End------///// 

    



    ///----- select box select function Start-----/////
    function loadSelectOptions({
        url,
        selectId,
        valueField = 'id',
        textField = 'name',
        placeholder = 'Select an option',
        extraTextField = null,
        params = {},
        selectedValue = null  // নতুন প্যারামিটার
    }) {
        $.ajax({
            url: url,
            type: 'GET',
            data: params,
            dataType: 'json',
            success: function(data) {
                let options = `<option value="">${placeholder}</option>`;
                $.each(data, function(index, item) {
                    let text = item[textField];
                    if (extraTextField && item[extraTextField]) {
                        text += ' - ' + item[extraTextField];
                    }
                    const isSelected = (selectedValue && item[valueField] == selectedValue) ? 'selected' : '';
                    options += `<option value="${item[valueField]}" ${isSelected}>${text}</option>`;
                });
                $(selectId).html(options);
            },
            error: function(xhr, status, error) {
                console.error('Error loading select options:', error);
                $(selectId).html('<option value="">Error loading data</option>');
            }
        });
    }

    ///----- City Name ------///
    function loadDependentDropdown(url, sourceSelector, targetSelector, postKey = 'id') {
        const selectedValue = $(sourceSelector).val();

        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: {
                [postKey]: selectedValue,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                let output = '<option value="">Select One</option>';
                $.each(data, function(index, item) {
                    output += '<option value="' + item.locationCode + '">' + item.locationName + ', '+ item.state_code +'</option>';
                });
                $(targetSelector).html(output);
            },
            error: function(xhr) {
                console.error("AJAX Error: ", xhr.responseText);
            }
        });
    }

    function loadSelectOptions2({ url, selectId, valueField, textField, placeholder }, callback = null) {
        $.get(url, function (data) {
            let options = placeholder ? `<option value="">${placeholder}</option>` : '';
            data.forEach(item => {
                options += `<option value="${item[valueField]}">${item[textField]}</option>`;
            });

            if (selectId instanceof jQuery) {
                selectId.html(options);
            } else {
                selectId = $(selectId);
                selectId.html(options);
            }

            // ✅ Call the callback after options are loaded
            if (typeof callback === 'function') {
                callback(selectId);
            }
        });
    }
    ///----- select box select function End -----/////


   


    ////---- Set up Customer Autocomplete autocomplete based on shipper, consignee, or notify-----/////
    function setupCustomerAutocomplete(type) {
        let dataMap = {};
        let selectedIndex = -1;

        const $input = $(`#${type}_name`);
        const $suggestionBox = $(`#${type}_suggestions_box`);
        const $loader = $(`#${type}_loader`);

        const clearMessage = () => $(`#${type}_message`).text('');
        const showMessage = (msg) => $(`#${type}_message`).text(msg);

        const clearDetails = () => {
            $(`#${type}_address, #${type}_phone, #${type}_email, #${type}_registration, #${type}_country, #${type}_location, #${type}_zip_code, #${type}_code`).val('');
        };

        const fillDetails = data => {
            $(`#${type}_address`).val(data.customerAddress);
            $(`#${type}_phone`).val(data.customerAddressPhone);
            $(`#${type}_email`).val(data.customerAddressEmail);
            $(`#${type}_registration`).val(data.customer_address_bin_number);
            $(`#${type}_country`).val(data.customerAddressCountry);
            $(`#${type}_location`).val(data.address_city);
            $(`#${type}_zip_code`).val(data.address_zip);
            $(`#${type}_code`).val(data.customerCode);
        };

        const highlightItem = ($items) => {
            $items.removeClass('active');
            if (selectedIndex < 0) return;

            const $current = $items.eq(selectedIndex);
            $current.addClass('active');

            // Ensure scroll into view
            $current[0]?.scrollIntoView({
                behavior: 'smooth',
                block: 'nearest',
                inline: 'nearest'
            });
        };

        const fetchSuggestions = (name) => {
            $loader.show();
            $.ajax({
                url: "{{ url('get-customer-details') }}",
                type: 'GET',
                data: { name },
                success: (response) => {
                    $loader.hide();
                    $suggestionBox.empty();
                    dataMap = {};

                    if (response.status && response.data.length > 0) {
                        let tableHTML = '<table class="table table-striped mb-0"><tbody>';
                        response.data.forEach(customer => {
                            dataMap[customer.customer_full_name] = customer;
                            tableHTML += `
                                <tr style="cursor: pointer;">
                                    <td>
                                        <div data-name="${customer.customer_full_name}" style="width: 250px;">
                                            ${customer.customer_full_name}
                                        </div>
                                    </td>
                                </tr>
                            `;
                        });
                        tableHTML += '</tbody></table>';

                        $suggestionBox.html(tableHTML).show();
                    } else {
                        $suggestionBox.hide();
                    }
                },
                error: () => {
                    $loader.hide();
                    $suggestionBox.hide();
                }
            });
        };

        $input.on('input', () => {
            clearMessage();
            const name = $input.val().trim();
            selectedIndex = -1;
            $suggestionBox.empty().hide();

            if (name) fetchSuggestions(name);
            else {
                clearDetails();
            }
        });

        $input.on('keydown', (e) => {
            const $items = $suggestionBox.find('div[data-name]');
            const count = $items.length;
            if (count === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedIndex = (selectedIndex + 1) % count;
                highlightItem($items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedIndex = (selectedIndex - 1 + count) % count;
                highlightItem($items);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (selectedIndex >= 0) {
                    $items.eq(selectedIndex).trigger('click');
                }
            }
        });

        $suggestionBox.on('click', 'div[data-name]', function () {
            const selectedName = $(this).data('name');
            $input.val(selectedName);
            $suggestionBox.hide();
            selectedIndex = -1;

            if (dataMap[selectedName]) {
                fillDetails(dataMap[selectedName]);
                clearMessage();
            } else {
                clearDetails();
                showMessage('Customer not found. Please click the ➕ icon to add a new customer.');
            }
        });

        $(document).on('click', (e) => {
            if (!$(e.target).closest(`#${type}_name, #${type}_suggestions_box`).length) {
                $suggestionBox.hide();
            }
        });
    }

    ////---- Set up POL/POD autocomplete based on Sea, Air, or Land-----/////
    function setupPolPodAutocomplete(type, seaAirLand) {
        let dataMap = {};
        let selectedIndex = -1;

        const $input = $(`#${type}`);
        const $suggestionBox = $(`#${type === 'from_location' ? 'pol' : 'pod'}_suggestions_box`);
        const $loader = $(`#${type === 'from_location' ? 'pol' : 'pod'}_loader`);

        const clearDetails = () => {};

        const fillDetails = data => {
            $input.val(data.locationCode);
        };

        const highlightItem = ($items) => {
            $items.removeClass('active');
            if (selectedIndex < 0) return;
            const $current = $items.eq(selectedIndex);
            $current.addClass('active');

            const container = $suggestionBox[0];
            const item = $current[0];
            const containerTop = container.scrollTop;
            const containerBottom = containerTop + container.clientHeight;
            const itemTop = item.offsetTop;
            const itemBottom = itemTop + item.offsetHeight;

            if (itemBottom > containerBottom)
                container.scrollTop = itemBottom - container.clientHeight;
            else if (itemTop < containerTop)
                container.scrollTop = itemTop;
        };

        const fetchSuggestions = (polpod) => {
            $loader.show();
            $.ajax({
                url: "{{ url('get-pol-pod-details') }}",
                type: 'POST',
                data: {
                    polpod: polpod,
                    seaAirLand: seaAirLand,
                    _token: '{{ csrf_token() }}'
                },
                success: (response) => {
                    $loader.hide();
                    $suggestionBox.empty();
                    dataMap = {};

                    if (response.status && response.data.length > 0) {
                        let tableHtml = `
                            <table class="table table-striped" style="width: 100%; border-collapse: collapse; font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 5%; padding: 4px; border: 1px solid #ccc;">-</th>
                                        <th class="text-center" style="padding: 4px; border: 1px solid #ccc;">Code</th>
                                        <th class="text-center" style="width: 12%; padding: 4px; border: 1px solid #ccc;">Country</th>
                                        <th class="text-center" style="padding: 4px; border: 1px solid #ccc;">Location Name</th>
                                        <th class="text-center" style="padding: 4px; border: 1px solid #ccc;">ZIP</th>
                                        <th class="text-center" style="padding: 4px; border: 1px solid #ccc;">State</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        response.data.forEach(item => {
                            const displayName = `${item.locationCode}`;
                            dataMap[displayName] = item;

                            let icon = '';
                            if (item.locationSeaAirLand == 1)
                                icon = '<i class="fa-solid fa-ship"></i>';
                            else if (item.locationSeaAirLand == 2)
                                icon = '<i class="fa-solid fa-plane"></i>';
                            else
                                icon = '<i class="fa-solid fa-plane-arrival"></i>';

                            tableHtml += `
                                <tr class="suggestion-row" data-name="${displayName}" style="cursor: pointer; font-size: 12px;">
                                    <td class="text-center" style="padding: 4px; border: 1px solid #ccc;">${icon}</td>
                                    <td style="padding: 4px; border: 1px solid #ccc;"><span style="margin-left: 4px;">${item.locationCode}</span></td>
                                    <td class="text-center" style="padding: 4px; border: 1px solid #ccc;">${item.countryCode}</td>
                                    <td style="padding: 4px; border: 1px solid #ccc;"><span style="margin-left: 4px;">${item.locationName}</span></td>
                                    <td class="text-center" style="padding: 4px; border: 1px solid #ccc;">${item.zip_code ?? ''}</td>
                                    <td style="padding: 4px; border: 1px solid #ccc;"><span style="margin-left: 4px;">${item.state_full ?? ''}</span></td>
                                </tr>
                            `;
                        });

                        tableHtml += `</tbody></table>`;
                        $suggestionBox.html(tableHtml).show();
                    } else {
                        $suggestionBox.hide();
                    }
                },
                error: () => {
                    $loader.hide();
                    $suggestionBox.hide();
                }
            });
        };

        $input.on('input', () => {
            const polpod = $input.val().trim();
            selectedIndex = -1;
            $suggestionBox.empty().hide();
            if (polpod) fetchSuggestions(polpod);
        });

        $input.on('keydown', (e) => {
            const $items = $suggestionBox.find('tr.suggestion-row');
            const count = $items.length;
            if (count === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                selectedIndex = (selectedIndex + 1) % count;
                highlightItem($items);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                selectedIndex = (selectedIndex - 1 + count) % count;
                highlightItem($items);
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (selectedIndex >= 0) {
                    $items.eq(selectedIndex).trigger('click');
                }
            }
        });

        $suggestionBox.on('click', '.suggestion-row', function () {
            const selectedName = $(this).data('name');
            $suggestionBox.hide();
            selectedIndex = -1;

            if (dataMap[selectedName]) {
                fillDetails(dataMap[selectedName]);
            } else {
                clearDetails();
            }
        });

        $(document).on('click', (e) => {
            if (!$(e.target).closest($input).length && !$(e.target).closest($suggestionBox).length) {
                $suggestionBox.hide();
            }
        });
    }

    // ✅ ফোকাস হারানো রোধের জন্য mousedown ও click দুইটাতেই preventDefault
    $(document).on('mousedown click', '.suggestions-box', function (e) {
        e.preventDefault();
    });


    ///---- The modal should not close when clicking outside of it. ----///
    $(document).ready(function () {
        $('#bs-example-modal-lg').modal({
            backdrop: 'static', // Modal বাইরে ক্লিক করলে বন্ধ হবে না
            keyboard: true      // ESC চাপলে modal বন্ধ হবে
        });

    });



















// $(document).ready(function(){

//     // AJAX
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
    
//     /**
//      * SHOW SHIPPING CHARGE
//      */
//     function shippingCharge(){
//     }
//     shippingCharge();

//     /**
//      * ADD SHIPPING CHARGE
//      */

//     $(document).on("click", "#StoreSCharge", function(event){
//         event.preventDefault();

//         let title  = $("#title").val();
//         let shippingCharge  = $("#shippingCharge").val();

//         $.ajax({
//             url: "/shipping/store",
//             type: "POST",
//             data:{
//                 title: title,
//                 shipping_charge: shippingCharge
//             },
//             success: function(response){
//             },
//             error: function(){
//             }
//         });
//     });

//     /**
//      * EDIT SHPPING CHARGE
//      */

//     $(document).on("click", ".EditShipping", function(e){
//         e.preventDefault();
        
//         const EditUrl = $(this).data('url');

//         $.ajax({
//             url: EditUrl,
//             type: "GET",
//             dataType: "json", // Expect a JSON response
//             success: function(response){
//             }
//         });
//     });

//     /**
//      * UPDATE SHIPPING
//      */
//     $(document).on("click", "#UpdateShipping", function(e){
//         e.preventDefault();

//         let sid = $("#sid").val();
//         let title  = $("#Etitle").val();
//         let shippingCharge  = $("#EshippingCharge").val();
//         let status  = $("#status").val();

//         $.ajax({
//             url: `/shipping/update/${sid}`,
//             type: "POST",
//             data:{
//                 title: title,
//                 shipping_charge: shippingCharge,
//                 status: status
//             },
//             success: function(response){
//                 if(response.status == '200'){
//                     $("#EditShippingChargeModal").modal('hide');
//                     $("#Etitle").val("");
//                     $("#EshippingCharge").val("");
//                     $("#status").val("");

//                     Swal.fire({
//                         text: response.message,
//                         icon: 'success',
//                         timer: 500,
//                         showConfirmButton: true
//                     });
//                     window.location.reload();
//                 }
//             }
//         });

//     });


    


//     /**
//      * DESTROY SHIPPING CHARGE
//      */
//     $(document).on("click", ".deleteCharge", function(e){
//         e.preventDefault();

//         const deleteUrl = $(this).data('url');
//         Swal.fire({
//             title: "Are you sure?",
//             text: "You want to delete the Shipping Charge!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#0d6efd",
//             cancelButtonColor: "#f41127",
//             confirmButtonText: "Yes, delete it!",
//           }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: deleteUrl,
//                     type: "GET",
//                     success: function(response){
//                         Swal.fire({
//                             text: response.message,
//                             icon: "success",
//                             timer: 500,
//                             showConfirmButton: true
//                         });
//                         shippingCharge();
//                     },
//                     error: function(){
//                         Swal.fire({
//                             title: "Error!",
//                             text: "There was a problem deleting the shipping charge.",
//                             icon: "error",
//                             confirmButtonColor: "#0d6efd",
//                             iconColor: '#f41127'
//                         });
//                     }
//                 });
              
//             }
//           });

//     })


// });


// $(function(){
//     // APPROVED PURCHASE
//     $(document).on("click","#approveBtn", function(e){
//         e.preventDefault();
//         var link = $(this).attr("href");

//     })
// });












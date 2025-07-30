   // CSRF Token setup for all AJAX requests
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


    //------ Show Modal ------////
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
                        notyf.success(res.message);

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


                        const title = window.transText.err_ttl_msg;
                        const msg = window.transText.err_msg;
                        const fullMessage = `${title}: ${msg}`;

                        notyf.open({
                            type: 'error',
                            message: fullMessage
                        });

                    } else {
                        Swal.fire('Error', 'Something went wrong!', 'error');
                    }
                }
            });
        });
    }


    // Form Submit 1
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

    //----- Data Active and Inactive Start------/////
    function toggleStatusUpdate(id, status, url) {
        $.post(url, { id, status })
            .done(() => {
                Swal.fire({
                    text: status === 'A' ? window.transText.actv_msg : window.transText.dact_msg,
                    icon: "success",
                    timer: 1000,
                    showConfirmButton: true
                });
            })
            .fail(() => {
                Swal.fire({
                    icon: 'error',
                    title: window.transText.err_ttl_msg,
                    text: window.transText.err_msg
                });
            });
    }
    //----- Data Active and Inactive End------///// 

    
    ///----- select box select function Start-----////
    function loadSelectOptions({
        url,
        selectId,
        valueField = 'id',
        textField = 'name',
        placeholder = 'Select an option',
        extraTextField = null,
        params = {},
        selectedValue = null,
        callback = null
    }) {
        $.ajax({
            url: url,
            type: 'POST',
            data: params,
            dataType: 'json',
            success: function (data) {
                let options = `<option value="">${placeholder}</option>`;

                if (data.length === 1 && !selectedValue) {
                    selectedValue = data[0][valueField];
                }

                $.each(data, function (index, item) {
                    let text = item[textField];
                    if (extraTextField && item[extraTextField]) {
                        text += ' - ' + item[extraTextField];
                    }

                    const isSelected = (selectedValue && item[valueField] == selectedValue) ? 'selected' : '';
                    options += `<option value="${item[valueField]}" ${isSelected}>${text}</option>`;
                });

                $(selectId).html(options);

                if (typeof callback === 'function') {
                    callback();
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading select options:', error);
                $(selectId).html('<option value="">Error loading data</option>');
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
    
    ///----- City Name ------///
    function loadDependentDropdown(url, sourceSelector, targetSelector, postKey = 'id') {
        const selectedValue = $(sourceSelector).val();

        $.ajax({
            url: url,
            method: "POST",
            dataType: "json",
            data: {
                [postKey]: selectedValue,
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

    




   
    ////---- Set up Customer Autocomplete autocomplete based on shipper, consignee, or notify-----/////
    function setupCustomerAutocomplete(type, fetchUrl) {
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
                url: fetchUrl,
                type: 'POST',
                data: { name },
                success: (response) => {
                    $loader.hide();
                    $suggestionBox.empty();
                    dataMap = {};

                    if (response.length > 0) {
                        let tableHTML = `
                            <table class="table table-striped" style="width: 100%; border-collapse: collapse; font-size: 13px;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 20px; padding: 4px; border: 1px solid #ccc;">-</th>
                                        <th class="text-center" style="width: 60px; padding: 4px; border: 1px solid #ccc;">CODE</th>
                                        <th class="text-center" style="width: 150px; padding: 4px; border: 1px solid #ccc;">NAME</th>
                                        <th class="text-center" style="width: 300px; padding: 4px; border: 1px solid #ccc;">ADDRESS</th>
                                        <th class="text-center" style="width: 100px; padding: 4px; border: 1px solid #ccc;">CITY</th>
                                        <th class="text-center" style="width: 100px; padding: 4px; border: 1px solid #ccc;">STATE</th>
                                        <th class="text-center" style="width: 100px; padding: 4px; border: 1px solid #ccc;">ZIP</th>
                                        <th class="text-center" style="width: 120px; padding: 4px; border: 1px solid #ccc;">LICENSE</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;
                        response.forEach((customer, index) => {
                            dataMap[customer.customer_full_name] = customer;
                            tableHTML += `
                                <tr class="suggestion-row" data-name="${customer.customer_full_name}" style="cursor: pointer; font-size: 12px;">
                                    <td class="text-center" style="width: 20px; padding: 4px!important; border: 1px solid #ccc;">${index + 1}</td>
                                    <td class="text-center" style="width: 60px; padding: 4px!important; border: 1px solid #ccc;">${customer.customerCode}</td>
                                    <td style="width: 150px; padding: 4px!important; border: 1px solid #ccc;">${customer.customer_full_name}</td>
                                    <td style="width: 300px; padding: 4px!important; border: 1px solid #ccc;">${customer.customerAddress}</td>
                                    <td class="text-center" style="width: 100px; padding: 4px!important; border: 1px solid #ccc;">${customer.address_city}</td>
                                    <td style="width: 100px; padding: 4px!important; border: 1px solid #ccc;">${customer.address_state}</td>
                                    <td class="text-center" style="width: 100px; padding: 4px!important; border: 1px solid #ccc;">${customer.address_zip}</td>
                                    <td class="text-center" style="width: 120px; padding: 4px!important; border: 1px solid #ccc;">${customer.customer_address_bin_number}</td>
                                </tr>
                            `;
                        });
                        tableHTML += '</tbody></table>';

                        $suggestionBox.html(tableHTML).show();
                    }
                    else {
                        $suggestionBox.hide();
                    }
                },
                error: () => {
                    $loader.hide();
                    $suggestionBox.hide();
                }
            });
        };

        // ✅ INPUT EVENT WITH 3-CHARACTER CONDITION
        $input.on('input', () => {
            clearMessage();
            const name = $input.val().trim();
            selectedIndex = -1;
            $suggestionBox.empty().hide();

            if (name.length >= 3) {
                fetchSuggestions(name);
            } else {
                clearDetails();
            }
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

        $suggestionBox.on('click', 'tr.suggestion-row', function () {
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
    function setupPolPodAutocomplete(type, seaAirLand, fetchUrl = null) {
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
                url: fetchUrl,
                type: 'POST',
                data: {
                    polpod: polpod,
                    seaAirLand: seaAirLand,
                },
                success: (response) => {

                    $loader.hide();
                    $suggestionBox.empty();
                    dataMap = {};

                    if (response.length > 0) {
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

                        response.forEach(item => {
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
                        
                        // Show suggestion box
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

        // ✅ Only fetch if input has 3 or more characters
        $input.on('input', () => {
            const polpod = $input.val().trim();
            selectedIndex = -1;
            $suggestionBox.empty().hide();

            if (polpod.length >= 3) {
                fetchSuggestions(polpod);
            } else {
                clearDetails();
            }
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
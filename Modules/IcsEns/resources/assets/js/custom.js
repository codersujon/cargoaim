$(document).ready(function () {
        
    let today = new Date(); 
    let sevenDaysAgo = new Date();
    sevenDaysAgo.setDate(today.getDate() - 7);

    flatpickr("#date_range_from", {
        dateFormat: "d-m-Y",
        defaultDate: sevenDaysAgo,
        onReady: function(selectedDates, dateStr, instance) {
            instance.setDate(sevenDaysAgo, true);
        }
    });

    flatpickr("#date_range_to", {
        dateFormat: "d-m-Y",
        defaultDate: today,
        onReady: function(selectedDates, dateStr, instance) {
            instance.setDate(today, true);
        }
    });

    // ------ New Container Row -----///
    function getNewContainerRow(rowNumber = 1) {
        return `
        <tr class="text-center">
            <td style="width: 20px;">${rowNumber}</td>
            <td style="width: 100px;">
                <input type="text" name="container_no[]" class="form-control container-no" autocomplete="off" maxlength="11" required>
            </td>
            <td style="width: 55px;">
                <select class="form-select" name="size_iso[]" autocomplete="off" required>
                    <option value="">Loading...</option>
                </select> 
            </td>
            <td style="width: 108px;">
                <input type="text" name="seal_no[]" class="form-control seal_no" autocomplete="off" required>
            </td>
            <td style="width: 57px;">
                <input type="text" name="pkg_qty[]" class="form-control pkg_qty" autocomplete="off" required>
            </td>
            <td style="width: 82px;">
                <select class="form-select" name="pkg_type[]" autocomplete="off" required>
                    <option value="">Loading...</option>                                                    
                </select>
            </td>
            <td style="width: 60px;">
                <input type="text" name="weight_kg[]" class="form-control weight_kg" autocomplete="off" required>
            </td>
            <td style="width: 57px;">
                <input type="text" name="cbm[]" class="form-control cbm" autocomplete="off" required>
            </td>
            <td style="width: 65px;">
                <input type="text" name="hs_code[]" class="form-control hs_code" autocomplete="off" required>
            </td>
            <td style="width: 50px;">
                <input type="text" name="un_code_dg[]" class="form-control un_code_dg" autocomplete="off">
            </td>
            <td style="width: 130px;">
                <input type="text" name="cargo_marks[]" class="form-control" autocomplete="off" required>
            </td>
            <td>
                <input type="text" name="cargo_description[]" class="form-control" autocomplete="off" required>
            </td>
            <td style="width: 25px;">
                <i class="fa-solid fa-floppy-disk m-1 saveIcon" title="Save" style="cursor: pointer;"></i>
            </td>
            <td style="width: 25px;">
                <i class="fa-solid fa-copy m-1 copyRow" title="Copy" style="cursor: pointer;"></i>
            </td>
            <td style="width: 30px;">
                <i class="fa-solid fa-trash" title="Delete" style="color: #CD1212; cursor: pointer;"></i>
            </td>
        </tr>
        `;
    }

    //---- Billing id ---//
    loadSelectOptions({
        url: getBillFiling,
        selectId: '#billing_id',
        valueField: 'billing_id',
        textField: 'billing_id',
        placeholder: ''
    });

    //---- HBL EORI ---//
    loadSelectOptions({
        url: getHblEoriUrl,
        selectId: '#nvocc_scac',
        valueField: 'eori_code',
        textField: 'scac_eori_full',
        extraTextField: 'eori_code',
        placeholder: ''
    });

    //---- MBL EORI ----///
    loadSelectOptions({
        url: getMblEoriUrl,
        selectId: '#carrier_scac',
        valueField: 'eori_code',
        textField: 'scac_eori_full',
        extraTextField: 'eori_code',
        placeholder: ''
    });

    ///----- TS Country ----//
    const transshipmentPorts = [
        { id: '#ts_one', placeholder: '' },
        { id: '#ts_two', placeholder: '' },
        { id: '#ts_three', placeholder: '' }
    ];

    transshipmentPorts.forEach(port => {
        loadSelectOptions({
            url: getCtryCde,
            selectId: port.id,
            valueField: 'countryCode',
            textField: 'countryCode',
            extraTextField: 'countryName',
            placeholder: port.placeholder,
            params: { ts_country: 'Y' } // Y or N or কিছুই না

        });
    });


    //---- Customer Country Code ----///
    loadSelectOptions({
        url: getCtryCde,
        selectId: '#customerAddressCountry',
        valueField: 'countryCode',
        textField: 'countryCode',
        extraTextField: 'countryName',
        placeholder: 'Please Select'
    });

    //---- Customer City ----///
    $('#customerAddressCountry').change(function() {
        loadDependentDropdown(getCity, '#customerAddressCountry', '#address_city', 'countryCode');
    });


    // Call setup for 'shipper'
    setupCustomerAutocomplete('shipper', getCstDtl);
    setupCustomerAutocomplete('consignee', getCstDtl);
    setupCustomerAutocomplete('notify', getCstDtl);

    // ✅ Call setup for different fields with seaAirLand types
    setupPolPodAutocomplete('from_location', 1, getPolPodDtl); // 1 = Sea
    setupPolPodAutocomplete('to_location', 1, getPolPodDtl);   // 2 = Air (or 3 = Land)



    // New Modal Open Event delegation দিয়ে click handler
    $(document).on('click', '#createNew1', function () {
        var save =  window.transText.save_btn;
        var createNew =  window.transText.ics2_hbl_ens_create_new;

        // tbody clear
        $('#containerTbody').html('');

        // append new row
        $('#containerTbody').append(getNewContainerRow(1));

        // 🔁 এখন নতুন row এর ভেতরে select এ data load করান
        const $lastRow = $('#containerTbody tr').last();

        // Container Size load
        loadSelectOptions({
            url: getCntrSize,
            selectId: $lastRow.find('select[name="size_iso[]"]'),
            valueField: 'eq_code',
            textField: 'eq_size_display',
            placeholder: ''
        });

        // Package Type load
        loadSelectOptions({
            url: getPKG,
            selectId: $lastRow.find('select[name="pkg_type[]"]'),
            valueField: 'pkg_code',
            textField: 'pkg_code',
            extraTextField: 'pkg_description',
            placeholder: ''
        });

        // show modal
        showModalForCreateNew(save, createNew);
        disableAllSaveIcons();
    });


    // Submit Button Click
    submitFormWithAjax1('#form', "{{ url('ics_ens') }}");

    // Function to disable all .saveIcon elements
    function disableAllSaveIcons() {
        $('.saveIcon').each(function () {
            $(this).css({
                'pointer-events': 'none',
                'opacity': '0.4',
                'cursor': 'not-allowed'
            }).prop('disabled', true);
        });
    }

    // Function to enable all .saveIcon elements
    function enableAllSaveIcons() {
        $('.saveIcon').each(function () {
            $(this).css({
                'pointer-events': 'auto',
                'opacity': '1',
                'cursor': 'pointer'
            }).prop('disabled', false);
        });
    }


    ////----- Filing Fetch data Load------////

    $('#loadform').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        // Show loader before sending AJAX
        $('#loader').fadeIn();

        $.ajax({
            type: "POST",
            url: "{{ url('/filing_fetch') }}",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);

                let dataEmptyMsg = window.transText.data_empty_msg;
                let tryMsg = window.transText.try_msg;

                if (response && response.length > 0) {
                    $('.listTable').show();
                    $('#hbl_content_div').hide();
                    $('#dataBody').empty(); // clear old data if any

                    let html = '';
                    let i = 1;

                    response.forEach(function (item) {
                        html += `
                            <tr>
                                <td style="width: 10px;"><input type="checkbox" name="check_name" id="check_id" /></td>
                                <td class="text-center" style="width: 10px;">${i++}</td>
                                <td class="text-center bg-info" style="width: 100px;">${item.mbl_no ?? ''}</td>
                                <td class="text-center bg-warning" style="width: 100px;">${item.filing_t_ultimate_hbl_no ?? ''}</td>
                                <td class="text-center" style="width: 40px;">
                                    <button type="button" data-id="${item.row_id}" class="btn btn-sm btn-info editBtn" style="margin: 2px 0px;">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                </td>
                                <td class="text-center" style="width: 40px;">
                                    <button type="button" class="btn btn-sm btn-dark copyBtn" data-copy="${item.filing_t_ultimate_hbl_no ?? ''}" style="margin: 2px 0px;">
                                        <i class="fa-solid fa-copy" title="Copy" style="cursor: pointer;"></i>
                                    </button>                                    
                                </td>
                                <td class="text-center bg-light" style="width: 120px;">${item.ens_mrn_no ?? ''}</td>
                                <td class="text-center bg-light" style="width: 50px;">${item.status ?? ''}</td>
                                <td class="text-center bg-light" style="width: 50px;">${item.ens_disposition_code ?? ''}</td>
                                <td class="text-center" style="width: 20px;">${item.eq_qty ?? ''}</td>
                                <td class="text-center" style="width: 30px;">${item.pky_qty ?? ''}</td>
                                <td class="text-center" style="width: 40px;">${item.weight_kg ?? ''}</td>
                                <td class="text-center" style="width: 50px;">${item.cbm ?? ''}</td>
                                <td class="text-center" style="width: 30px;">${item.to_location ?? ''}</td>
                                <td style="width: 150px;">${item.shipper_name ?? ''}</td>
                                <td style="width: 150px;">${item.consignee_name ?? ''}</td>
                                <td style="width: 20px;">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-sm btn-info me-2">
                                            <i class="fa-solid fa-bolt"></i>
                                        </button>
                                    </div>
                                </td>
                                <td style="width: 20px;">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-sm btn-danger me-2 deleteBtn" data-id="${item.row_id}">
                                            <i class="fa-solid fa-trash" title="Delete" style="cursor: pointer;"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                    });

                    $('#dataBody').html(html);
                    $('table.table-striped').show();

                } else {
                    $('.listTable').hide();
                    $('#dataBody').empty();

                    $('#hbl_content_div').html(`
                        <div style="
                            padding: 2.25rem;
                            border-radius: 12px;
                            background-color: #f9fafb;
                            border: 1.5px solid var(--osen-topbar-bg, #ddd);
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
                            text-align: left;
                            color: #6b7280;
                            font-family: 'Segoe UI', sans-serif;
                        ">
                            <h5 style="font-size: 16px; margin-bottom: 8px;">📄 ${dataEmptyMsg}</h5>
                            <p style="margin: 5px 5px 0; font-size: 14px; color: #9ca3af;">
                                ${tryMsg}.
                            </p>
                        </div>
                    `).show();
                }
                // Hide loader after completion
                $('#loader').fadeOut();
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });
    });

    
    
    // Edit Button Click
    loadEditDataToModal(
        '.editBtn',
        "{{ url('/ics_ens') }}",
        '#bs-example-modal-lg',
        [
            { selector: '#row_id', key: 'main.row_id' },
            { selector: '#billing_id', key: 'main.billing_id' },
            { selector: '#nvocc_scac', key: 'main.nvocc_scac' },
            { selector: '#hbl_no', key: 'main.hbl_no' },
            { selector: '#mbl_no', key: 'main.mbl_no' },
            { selector: '#carrier_scac', key: 'main.carrier_scac' },
            { selector: '#import_export', key: 'main.import_export' },
            { selector: '#from_location', key: 'main.from_location' },
            { selector: '#to_location', key: 'main.to_location' },
            { selector: '#ts_one', key: 'main.ts_one' },
            { selector: '#ts_two', key: 'main.ts_two' },
            { selector: '#ts_three', key: 'main.ts_three' },
            { selector: '#incoterm', key: 'main.incoterm' },
            { selector: '#shipper_name', key: 'main.shipper_name' },
            { selector: '#shipper_address', key: 'main.shipper_address' },
            { selector: '#shipper_country', key: 'main.shipper_country' },
            { selector: '#shipper_location', key: 'main.shipper_location' },
            { selector: '#shipper_phone', key: 'main.shipper_phone' },
            { selector: '#shipper_zip_code', key: 'main.shipper_zip_code' },
            { selector: '#shipper_email', key: 'main.shipper_email' },
            { selector: '#shipper_registration', key: 'main.shipper_registration' },
            { selector: '#shipper_code', key: 'main.shipper_code' },
            { selector: '#consignee_name', key: 'main.consignee_name' },
            { selector: '#consignee_address', key: 'main.consignee_address' },
            { selector: '#consignee_country', key: 'main.consignee_country' },
            { selector: '#consignee_location', key: 'main.consignee_location' },
            { selector: '#consignee_phone', key: 'main.consignee_phone' },
            { selector: '#consignee_zip_code', key: 'main.consignee_zip_code' },
            { selector: '#consignee_email', key: 'main.consignee_email' },
            { selector: '#consignee_registration', key: 'main.consignee_registration' },
            { selector: '#consignee_code', key: 'main.consignee_code' },
            { selector: '#notify_name', key: 'main.notify_name' },
            { selector: '#notify_address', key: 'main.notify_address' },
            { selector: '#notify_country', key: 'main.notify_country' },
            { selector: '#notify_location', key: 'main.notify_location' },
            { selector: '#notify_phone', key: 'main.notify_phone' },
            { selector: '#notify_zip_code', key: 'main.notify_zip_code' },
            { selector: '#notify_email', key: 'main.notify_email' },
            { selector: '#notify_registration', key: 'main.notify_registration' },
            { selector: '#notify_code', key: 'main.notify_code' },
        ],
        'Edit Customer Filing',
        'Update',
        function (response) {
            const details = response.details || [];

            const columns = [
                { name: 'row_id_eqd', type: 'hidden' },
                { name: 'container_no', type: 'input', class: 'form-control container-no', width: '100px' },
                { name: 'size_iso', type: 'select', class: 'form-select size_iso', width: '55px', required: true, options: ['20GP', '40GP', '40HQ'] },
                { name: 'seal_no', type: 'input', class: 'form-control seal_no', width: '108px' },
                { name: 'pkg_qty', type: 'input', class: 'form-control pkg_qty', width: '57px' },
                { name: 'pkg_type', type: 'select', class: 'form-select pkg_type', width: '82px', options: ['BOX', 'CRT', 'PALLET'] },
                { name: 'weight_kg', type: 'input', class: 'form-control weight_kg', width: '60px' },
                { name: 'cbm', type: 'input', class: 'form-control cbm', width: '57px' },
                { name: 'hs_code', type: 'input', class: 'form-control hs_code', width: '65px' },
                { name: 'un_code_dg', type: 'input', class: 'form-control un_code_dg', width: '50px' },
                { name: 'cargo_marks', type: 'input', class: 'form-control cargo_marks', width: '130px' },
                { name: 'cargo_description', type: 'input', class: 'form-control cargo_description' }
            ];

            const actionIcons = [
                {
                    icon: 'fa-floppy-disk',
                    class: 'saveIcon',
                    title: 'Save',
                    style: 'cursor: pointer;'
                },
                {
                    icon: 'fa-copy',
                    class: 'copyRow',
                    title: 'Copy',
                    style: 'cursor: pointer;'
                },
                {
                    icon: 'fa-trash',
                    class: '',
                    title: 'Delete',
                    style: 'color: #CD1212; cursor: pointer;'
                }
            ];

            let tbodyHtml = '';

            if (details.length > 0) {
                details.forEach(function (item, index) {
                    // row start
                    tbodyHtml += `<tr class="text-center addedRow2" data-row-id-eqd="${item['row_id_eqd'] || ''}" style="width: 20px;"><td>${index + 1}</td>`;


                    columns.forEach(function (col) {
                        const value = item[col.name] || '';
                        const widthStyle = col.width ? ` style="width: ${col.width};"` : '';

                        if (col.type === 'hidden') {
                            tbodyHtml += `<input type="hidden" name="${col.name}[]" value="${value}">`;
                        } else if (col.type === 'input') {
                            tbodyHtml += `<td${widthStyle}><input type="text" name="${col.name}[]" class="${col.class}" value="${value}" autocomplete="off"></td>`;
                        } else if (col.type === 'select') {
                            let optionsHtml = '';
                            (col.options || []).forEach(opt => {
                                const selected = (opt.toLowerCase() === (value || '').toLowerCase()) ? 'selected' : '';
                                optionsHtml += `<option value="${opt}" ${selected}>${opt}</option>`;
                            });
                            tbodyHtml += `<td${widthStyle}><select name="${col.name}[]" class="${col.class}" ${col.required ? 'required' : ''}>${optionsHtml}</select></td>`;
                        }

                    });


                    actionIcons.forEach(icon => {
                        tbodyHtml += `<td style="width: 25px;">
                            <i class="fa-solid ${icon.icon} m-1 ${icon.class}" title="${icon.title}" style="${icon.style}"></i>
                        </td>`;
                    });

                    tbodyHtml += `</tr>`;
                });
            } else {
                tbodyHtml = `<tr><td colspan="15" class="text-center">No details found</td></tr>`;
            }

            $('#containerTbody').html(tbodyHtml);

            loadSelectOptions({
                url: getCntrSize,
                selectId: '.size_iso',
                valueField: 'eq_code',
                textField: 'eq_size_display',
                placeholder: ''
            });

            loadSelectOptions({
                url: getPKG,
                selectId: '.pkg_type',
                valueField: 'pkg_code',
                textField: 'pkg_code',
                extraTextField: 'pkg_description',
                placeholder: ''
            });




            enableAllSaveIcons(); // Optional
        }
    );


    /// -----row add---//
    $('#addRowBtn').click(function () {
        addNewRow();
        var savebutton = $('#saveBtn').text().trim();
        if (savebutton == 'Save') {                    
            disableAllSaveIcons();
        }else{
            enableAllSaveIcons();
        }
    });

    function addNewRow() {
        let row = `
            <tr class="text-center addedRow">
                <td></td>
                <td style="width: 90px;"><input type="text" name="container_no[]" class="form-control container-no" required maxlength="11" autocomplete="off"></td>
                <td style="width: 55px;">
                    <select class="form-select size_iso_select" name="size_iso[]" required autocomplete="off">
                        <option value="">Loading...</option>
                    </select>
                </td>
                <td style="width: 85px;"><input type="text" name="seal_no[]" class="form-control seal_no" required autocomplete="off"></td>
                <td style="width: 57px;"><input type="text" name="pkg_qty[]" class="form-control pkg_qty" required autocomplete="off"></td>
                <td style="width: 82px;">
                    <select class="form-select pkg_type_select" name="pkg_type[]" required autocomplete="off">
                        <option value="">Loading...</option>
                    </select>
                </td>
                <td style="width: 60px;"><input type="text" name="weight_kg[]" class="form-control weight_kg" required autocomplete="off"></td>
                <td style="width: 57px;"><input type="text" name="cbm[]" class="form-control cbm" required autocomplete="off"></td>
                <td style="width: 65px;"><input type="text" name="hs_code[]" class="form-control hs_code" required autocomplete="off"></td>
                <td style="width: 50px;"><input type="text" name="un_code_dg[]" class="form-control un_code_dg" required autocomplete="off"></td>
                <td style="width: 130px;"><input type="text" name="cargo_marks[]" class="form-control" required autocomplete="off"></td>
                <td><input type="text" name="cargo_description[]" class="form-control" required autocomplete="off"></td>
                <td><i class="fa-solid fa-floppy-disk m-1 saveIcon" title="Save"></i></td>
                <td><i class="fa-solid fa-copy m-1 copyRow" title="Copy" style="cursor: pointer;"></i></td>
                <td><i class="fa-solid fa-trash deleteRow" title="Delete" style="color: #CD1212; cursor: pointer;"></i></td>
            </tr>
        `;
        $('#containerTbody').append(row);
        resetSerialNumbers();

        // 🟢 Apply loadSelectOptions to the newly added select
        let lastSelect = $('#containerTbody').find('select.size_iso_select').last();
        loadSelectOptions({
            url: getCntrSize,
            selectId: lastSelect,
            valueField: 'eq_code',
            textField: 'eq_size_display',
            placeholder: ''
        });
        // 🟢 Apply loadSelectOptions to the newly added select
        let lastSelect2 = $('#containerTbody').find('select.pkg_type_select').last();
        loadSelectOptions({
            url: getPKG,
            selectId: lastSelect2,
            valueField: 'pkg_code',
            textField: 'pkg_code',
            extraTextField: 'pkg_description',
            placeholder: ''
        });
    }

    ///--- row delete ---///
    $('#containerTbody').on('click', '.deleteRow', function () {
        $(this).closest('tr').remove();
        resetSerialNumbers();                
    });

    ///-----row copy ------///
    $('#containerTbody').on('click', '.copyRow', function () {
        let currentRow = $(this).closest('tr');
        let newRow = $('<tr class="text-center addedRow"></tr>');

        newRow.append(`<td></td>`); // SL column

        let copiedSizeIsoValue = '';

        currentRow.find('td').each(function (index) {
            if (index === 0 || index >= currentRow.find('td').length - 3) return;

            let $cell = $(this);
            let width = $cell.attr('style') || '';
            let input = $cell.find('input, select, textarea').first();

            if (!input.length) {
                newRow.append(`<td style="${width}"></td>`);
                return;
            }

            let tag = input.prop('tagName').toLowerCase();
            let name = input.attr('name');
            let value = input.val();
            let inputClass = input.attr('class') || '';
            let maxlength = input.attr('maxlength') ? `maxlength="${input.attr('maxlength')}"` : '';

            if (tag === 'input') {
                if (!inputClass.includes('form-control')) {
                    inputClass = `form-control ${inputClass}`.trim();
                }
                newRow.append(`
                    <td style="${width}">
                        <input type="text" name="${name}" class="${inputClass}" value="${value}" ${maxlength} autocomplete="off" required>
                    </td>
                `);
            } else if (tag === 'select') {
                if (name === 'size_iso[]') {
                    copiedSizeIsoValue = value;
                    newRow.append(`
                        <td style="${width}">
                            <select name="${name}" class="form-select size_iso_select" autocomplete="off" required>
                                <option value="">Loading...</option>
                            </select>
                        </td>
                    `);
                } else {
                    let options = '';
                    input.find('option').each(function () {
                        let selected = ($(this).val() === value) ? 'selected' : '';
                        options += `<option value="${$(this).val()}" ${selected}>${$(this).text()}</option>`;
                    });

                    if (!inputClass.includes('form-select')) {
                        inputClass = `form-select ${inputClass}`.trim();
                    }

                    newRow.append(`
                        <td style="${width}">
                            <select name="${name}" class="${inputClass}" autocomplete="off" required>
                                ${options}
                            </select>
                        </td>
                    `);
                }
            } else if (tag === 'textarea') {
                if (!inputClass.includes('form-control')) {
                    inputClass = `form-control ${inputClass}`.trim();
                }
                newRow.append(`
                    <td style="${width}">
                        <textarea name="${name}" cols="30" rows="1" class="${inputClass}" autocomplete="off" required>${value}</textarea>
                    </td>
                `);
            }
        });

        newRow.append(`
            <td><i class="fa-solid fa-floppy-disk m-1 saveIcon" title="Save"></i></td>
            <td><i class="fa-solid fa-copy m-1 copyRow" title="Copy" style="cursor: pointer;"></i></td>
            <td><i class="fa-solid fa-trash deleteRow" title="Delete" style="color: #CD1212; cursor: pointer;"></i></td>
        `);

        $('#containerTbody').append(newRow);
        resetSerialNumbers();

        var savebutton = $('#saveBtn').text().trim();
        if (savebutton == 'Save') {
            disableAllSaveIcons();
        } else {
            enableAllSaveIcons();
        }

        // ✅ Load container size via AJAX and set copied value
        let lastSelect = $('#containerTbody').find('select.size_iso_select').last();
        loadSelectOptions2({
            url: getCntrSize,
            selectId: lastSelect,
            valueField: 'eq_code',
            textField: 'eq_size_display',
            placeholder: ''
        }, function (selectEl) {
            selectEl.val(copiedSizeIsoValue); // Set after options loaded
        });
    });



    /// ---Reset Serial Numbers ----//
    function resetSerialNumbers() {
        $('#containerTbody tr').each(function (index) {
            $(this).find('td:first').text(index + 1);
        });
    }


    ///---- Close Modal ------///

    $(document).on('click', '.ins_modal_close', function () {
        allowLoadEditData = false;
        $(this).blur();

        // modal fields clear
        $('#bs-example-modal-lg').find('input, select, textarea').val('');
        
    });

    /// Uppercase Only  ////
    $(document).on('input', '.uppercase-only', function () {
        let value = $(this).val();
        let upper = value.toUpperCase();
        if (value !== upper) {
            $(this).val(upper);
        }
    });

    /// ALPHA, NUMBER, /, ., -  ////
    $('#hbl_no, #mbl_no').on('input', function () {
        var value = $(this).val();
        // অনুমোদিত: A-Z, a-z, 0-9, /, ., -
        var cleaned = value.replace(/[^a-zA-Z0-9\/.\-]/g, '');
        cleaned = cleaned.toUpperCase(); // বড় হাতের অক্ষর
        if (value !== cleaned) {
            $(this).val(cleaned);
        }
    });


    /// ALPHA, NUMBER
    $(document).on('input', '.container-no, .seal_no', function () {
        let value   = $(this).val();
        let cleaned = value.replace(/[^a-zA-Z0-9]/g, '') // শুধুমাত্র অক্ষর ও সংখ্যা রাখবে
                        .toUpperCase();               // বড় হাতের অক্ষরে রূপান্তরs
        if (value !== cleaned) {
            $(this).val(cleaned);
        }
    });

    ///// Number Dot Only ////
    $(document).on('input', '.pkg_qty, .hs_code', function () {
        let value = $(this).val();
        let cleaned = value.replace(/[^0-9]/g, ''); // শুধু সংখ্যা রাখে

        if (value !== cleaned) {
            $(this).val(cleaned);
        }
    });

    ///// Number Dot Only ////
    $(document).on('input', '.weight_kg, .cbm, .un_code_dg', function () {
        let value = $(this).val();
        
        // শুধুমাত্র সংখ্যা ও একটি মাত্র ডট রাখতে দিচ্ছে
        let cleaned = value.replace(/[^0-9.]/g, '')   // সংখ্যা ও ডট ছাড়া সব বাদ
        .replace(/(\..*)\./g, '$1'); // একটির বেশি ডট থাকলে কেটে ফেলবে
        
        if (value !== cleaned) {
            $(this).val(cleaned);
        }
    });

    ///// ALPHA Only ////
    $(document).on('input', '.from_location, .to_location', function () {
        let value = $(this).val();
        let cleaned = value.replace(/[^a-zA-Z]/g, '').toUpperCase(); // শুধু অক্ষর, বড় হাতের
        
        if (value !== cleaned) {
            $(this).val(cleaned);
        }
    });

});

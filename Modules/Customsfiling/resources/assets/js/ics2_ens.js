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
                <input type="text" name="un_code_dg[]" class="form-control uppercase-only" autocomplete="off">
            </td>
            <td style="width: 130px;">
                <input type="text" name="cargo_marks[]" class="form-control uppercase-only" autocomplete="off" required>
            </td>
            <td>
                <input type="text" name="cargo_description[]" class="form-control uppercase-only" autocomplete="off" required>
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

    //---- Liner Select ----///
    loadSelectOptions({
        url: urls.liner,
        selectId: '#stock_filter_carrier_name',
        valueField: 'eori_code',
        textField: 'full_name', // ✅ Laravel থেকে আসা 'full_name' key
        placeholder: ''
    });
    //---- Company Select ----///
    loadSelectOptions({
        url: urls.getBillFiling,
        selectId: '#stock_filter_b_unit',
        valueField: 'billing_id',
        textField: 'billing_id', // ✅ Laravel থেকে আসা 'full_name' key
        placeholder: ''
    });

    //---- Billing id ---//
    loadSelectOptions({
        url: urls.getBillFiling,
        selectId: '#billing_id',
        valueField: 'billing_id',
        textField: 'billing_id',
        placeholder: ''
    });

    //---- HBL EORI ---//
    loadSelectOptions({
        url: urls.getHblEoriUrl,
        selectId: '#nvocc_scac',
        valueField: 'eori_code',
        textField: 'scac_eori_full',
        extraTextField: 'eori_code',
        placeholder: ''
    });

    //---- MBL EORI ----///
    loadSelectOptions({
        url: urls.getMblEoriUrl,
        selectId: '#carrier_scac',
        valueField: 'eori_code',
        textField: 'scac_eori_full',
        extraTextField: 'eori_code',
        placeholder: ''
    });

    ///----- TS Country Start----//
    const transshipmentPorts = [
        { id: '#ts_one', placeholder: '' },
        { id: '#ts_two', placeholder: '' },
        { id: '#ts_three', placeholder: '' }
    ];
    transshipmentPorts.forEach(port => {
        loadSelectOptions({
            url: urls.getCtryCde,
            selectId: port.id,
            valueField: 'countryCode',
            textField: 'countryCode',
            extraTextField: 'countryName',
            placeholder: port.placeholder,
            params: { ts_country: 'Y' } // Y or N or কিছুই না

        });
    });
    ///----- TS Country End----//

    //---- Customer Country Code ----///
    loadSelectOptions({
        url: urls.getCtryCde,
        selectId: '#customerAddressCountry',
        valueField: 'countryCode',
        textField: 'countryCode',
        extraTextField: 'countryName',
        placeholder: 'Please Select'
    });

    //---- Customer City ----///
    $('#customerAddressCountry').change(function() {
        loadDependentDropdown(urls.getCity, '#customerAddressCountry', '#address_city', 'countryCode');
    });

    // Call setup for 'shipper'
    setupCustomerAutocomplete('shipper', urls.getCstDtl);
    setupCustomerAutocomplete('consignee', urls.getCstDtl);
    setupCustomerAutocomplete('notify', urls.getCstDtl);

    // ✅ Call setup for different fields with seaAirLand types
    setupPolPodAutocomplete('from_location', 1, urls.getPolPodDtl); // 1 = Sea
    setupPolPodAutocomplete('to_location', 1, urls.getPolPodDtl);   // 2 = Air (or 3 = Land)

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
            url: urls.getCntrSize,
            selectId: $lastRow.find('select[name="size_iso[]"]'),
            valueField: 'eq_code',
            textField: 'eq_size_display',
            placeholder: ''
        });

        // Package Type load
        loadSelectOptions({
            url: urls.getPKG,
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
    submitFormWithAjax('#form', urls.icsEns, submitLoadForm);

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



    ////----- Filing Fetch data Load Start------////
    function submitLoadForm() {
        let formData = new FormData($('#loadform')[0]);
        $('#loader').fadeIn(); // Show loader

        $.ajax({
            type: "POST",
            url: urls.filingFetch,
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log("Response:", response);

                let dataEmptyMsg = window.transText?.data_empty_msg ?? 'No data found';
                let tryMsg = window.transText?.try_msg ?? 'Please try again later';

                $('#dataBody').empty();

                if (Array.isArray(response) && response.length > 0) {
                    $('.listTable').show();
                    $('.listTable table').show();
                    $('#hbl_content_div').hide();

                    let html = '';
                    let i = 1;

                    response.forEach(function (item) {
                        html += `
                            <tr>
                                <td class="text-center"><input type="checkbox" name="check_name[]" value="${item.row_id}" /></td>
                                <td class="text-center">${i++}</td>
                                <td class="text-center">${item.mbl_no ?? ''}</td>
                                <td class="text-center">${item.ultimate_hbl_no ?? ''}</td>
                                <td class="text-center">
                                    <button type="button" data-id="${item.row_id}" class="btn btn-sm btn-info editBtn" style="margin: 4px 0px">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-dark copyBtn" data-copy="${item.filing_t_ultimate_hbl_no ?? ''}">
                                        <i class="fa-solid fa-copy"title="Copy"></i>
                                    </button>
                                </td>
                                <td class="text-center bg-light">${item.ens_mrn_no ?? ''}</td>
                                <td class="text-center bg-light">${item.ens_status_code ?? ''}</td>
                                <td class="text-center bg-light">${item.ens_disposition_code ?? ''}</td>
                                <td class="text-center">${item.eq_qty ?? '0'}</td>
                                <td class="text-center">${item.pky_qty ?? '0'}</td>
                                <td class="text-center">${item.weight_kg ?? '0'}</td>
                                <td class="text-center">${item.cbm ?? '0'}</td>
                                <td class="text-center">${item.to_location ?? ''}</td>
                                <td>${item.shipper_name ?? ''}</td>
                                <td>${item.consignee_name ?? ''}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-info actionBtn" data-id="${item.row_id}">
                                        <i class="fa-solid fa-bolt"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="${item.row_id}">
                                        <i class="fa-solid fa-trash" title="Delete"></i>
                                    </button>
                                </td>
                            </tr>`;
                    });

                    $('#dataBody').html(html);
                } else {
                    $('.listTable').hide();

                    $('#hbl_content_div').html(`
                        <div style="
                            padding: 2.25rem;
                            border-radius: 12px;
                            background-color: #f9fafb;
                            border: 1.5px solid #ddd;
                            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
                            text-align: left;
                            color: #6b7280;
                            font-family: 'Segoe UI', sans-serif;
                        ">
                            <h5 style="font-size: 16px; margin-bottom: 8px;">📄 ${dataEmptyMsg}</h5>
                            <p style="margin: 5px 5px 0; font-size: 14px; color: #9ca3af;">
                                ${tryMsg}
                            </p>
                        </div>
                    `).show();
                }

                $('#loader').fadeOut();
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#loader').fadeOut();
                alert('An error occurred while fetching data.');
            }
        });
    }
    $('#loadform').on('submit', function (e) {
        e.preventDefault();
        submitLoadForm(); // Call reusable function
    });
    ////----- Filing Fetch data Load End------////
    


    //-------- Edit Button Click start-------------///
    loadEditDataToModal(
        '.editBtn',
        urls.icsEns,
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

        window.transText.ics2_hbl_ens_create_new,
        window.transText?.update_btn ?? 'No data found',

        function (response) {
            const details = response.details || [];

            const columns = [
                { name: 'row_id_eqd', type: 'hidden' },
                { name: 'container_no', type: 'input', class: 'form-control container-no', width: '100px', required:true },
                { name: 'size_iso', type: 'select', class: 'form-select size_iso', width: '55px', required: true },
                { name: 'seal_no', type: 'input', class: 'form-control seal_no', width: '108px', required:true },
                { name: 'pkg_qty', type: 'input', class: 'form-control pkg_qty', width: '57px', required:true },
                { name: 'pkg_type', type: 'select', class: 'form-select pkg_type', width: '82px', required:true },
                { name: 'weight_kg', type: 'input', class: 'form-control weight_kg', width: '60px', required:true },
                { name: 'cbm', type: 'input', class: 'form-control cbm', width: '57px', required:true },
                { name: 'hs_code', type: 'input', class: 'form-control hs_code', width: '65px', required:true },
                { name: 'un_code_dg', type: 'input', class: 'form-control uppercase-only', width: '50px' },
                { name: 'cargo_marks', type: 'input', class: 'form-control cargo_marks uppercase-only', width: '130px', required:true },
                { name: 'cargo_description', type: 'input', class: 'form-control cargo_description uppercase-only', required:true }
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
                    tbodyHtml += `<tr class="text-center addedRow2" data-row-id-eqd="${item['row_id_eqd'] || ''}"><td style="width: 20px;">${index + 1}</td>`;

                    columns.forEach(function (col) {
                        const value = item[col.name] || '';
                        const widthStyle = col.width ? ` style="width: ${col.width};"` : '';

                        if (col.type === 'hidden') {
                            tbodyHtml += `<input type="hidden" name="${col.name}[]" value="${value}" ${col.required ? 'required' : ''}>`;
                        } else if (col.type === 'input') {
                            tbodyHtml += `<td${widthStyle}><input type="text" name="${col.name}[]" class="${col.class}" value="${value}" autocomplete="off"></td>`;
                        } else if (col.type === 'select') {
                            tbodyHtml += `<td${widthStyle}>
                                <select name="${col.name}[]" class="${col.class}" data-selected="${value}" ${col.required ? 'required' : ''}></select>
                            </td>`;
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

            // ✅ After rendering all rows, load dropdown options dynamically
            $('#containerTbody tr').each(function () {
                const $row = $(this);

                loadSelectOptions({
                    url: urls.getCntrSize,
                    selectId: $row.find('.size_iso'),
                    valueField: 'eq_code',
                    textField: 'eq_size_display',
                    selectedValue: $row.find('.size_iso').data('selected') || '',
                    placeholder: ''
                });

                loadSelectOptions({
                    url: urls.getPKG,
                    selectId: $row.find('.pkg_type'),
                    valueField: 'pkg_code',
                    textField: 'pkg_code',
                    extraTextField: 'pkg_description',
                    selectedValue: $row.find('.pkg_type').data('selected') || '',
                    placeholder: ''
                });
            });

            enableAllSaveIcons();
        }
    );
    $(document).on('input', '.container-no', function () {
        this.value = this.value.slice(0, 11); // ১১ অক্ষরের বেশি হলে কাটবে
    });
    //-------- Edit Button Click end-------------///


    ///-----row add start---//
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
                <td style="width: 50px;"><input type="text" name="un_code_dg[]" class="form-control uppercase-only" required autocomplete="off"></td>
                <td style="width: 130px;"><input type="text" name="cargo_marks[]" class="form-control uppercase-only" required autocomplete="off"></td>
                <td><input type="text" name="cargo_description[]" class="form-control uppercase-only" required autocomplete="off"></td>
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
            url: urls.getCntrSize,
            selectId: lastSelect,
            valueField: 'eq_code',
            textField: 'eq_size_display',
            placeholder: ''
        });
        // 🟢 Apply loadSelectOptions to the newly added select
        let lastSelect2 = $('#containerTbody').find('select.pkg_type_select').last();
        loadSelectOptions({
            url: urls.getPKG,
            selectId: lastSelect2,
            valueField: 'pkg_code',
            textField: 'pkg_code',
            extraTextField: 'pkg_description',
            placeholder: ''
        });
    }
    ///-----row add end---//

    ///--- row delete start---///
    $('#containerTbody').on('click', '.deleteRow', function () {
        $(this).closest('tr').remove();
        resetSerialNumbers();                
    });
    ///--- row delete end---///

    ///-----row copy start------///
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
            url: urls.getCntrSize,
            selectId: lastSelect,
            valueField: 'eq_code',
            textField: 'eq_size_display',
            placeholder: ''
        }, function (selectEl) {
            selectEl.val(copiedSizeIsoValue); // Set after options loaded
        });
    });
    ///-----row copy end------///

    /// ---Reset Serial Numbers start----//
    function resetSerialNumbers() {
        $('#containerTbody tr').each(function (index) {
            $(this).find('td:first').text(index + 1);
        });
    }
    /// ---Reset Serial Numbers end----//



    ///---- Close Modal start------///
    $(document).on('click', '.ins_modal_close', function () {
        allowLoadEditData = false;
        $(this).blur();

        // modal fields clear
        $('#bs-example-modal-lg').find('input, select, textarea').val('');
    });
    ///---- Close Modal end------///



    /// Uppercase Only  ////
    $(document).on('input', '.uppercase-only', function () {
        let value = $(this).val();
        let upper = value.toUpperCase();
        if (value !== upper) {
            $(this).val(upper);
        }
    });



    /// ALPHA, NUMBER, /, -, _, # ///
    $('#hbl_no, #mbl_no').on('input', function () {
        var value = $(this).val();
        // অনুমোদিত: A-Z, a-z, 0-9, /, -, _, #
        var cleaned = value.replace(/[^a-zA-Z0-9\/\-_#]/g, '');
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
    $(document).on('input', '.weight_kg, .cbm', function () {
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

<?php

namespace Modules\Customsfiling\Http\Controllers;

use Modules\Core\Models\CustomerAddress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CustomerAddressController extends Controller
{
    public function index() {}

    public function create() {}

    public function store(Request $request) 
    {
        $user = Auth::guard('web')->user();
        $soft_cust_id = $user->soft_cust_id;

        // Validate inputs
        $validated = $request->validate([
            'customer_full_name' => 'required|string',
            'customerAddressCountry' => 'required|string',
            'customerAddressEmail' => 'required|email',
            'customerAddressPhone' => 'required|string',
            'address_zip' => 'required|string',
        ]);

        $dateTime = Carbon::now();
        $isUpdate = !empty($request->rowId);

        // Generate customerCode if creating new
        if (!$isUpdate) {
            $max = CustomerAddress::where('soft_cust_id', $soft_cust_id)
                ->where('customerAddressCountry', $request->customerAddressCountry)
                ->max(DB::raw('CAST(SUBSTRING(customerCode, -5) AS UNSIGNED)'));

            $number = str_pad(($max + 1), 5, '0', STR_PAD_LEFT);
            $customerCode = $request->customerAddressCountry . $number;
        } else {
            $customerCode = $request->customerCode;
        }

        // Prepare data
        $data = [
            'soft_cust_id' => $soft_cust_id,
            'customerCode' => $customerCode,
            'customer_full_name' => $request->customer_full_name,
            'customerAddressPhone' => $request->customerAddressPhone,
            'customerAddressEmail' => $request->customerAddressEmail,
            'customer_address_bin_number' => $request->customer_address_bin_number,
            'customerAddressCountry' => $request->customerAddressCountry,
            'address_city' => $request->address_city,
            'address_zip' => strtoupper($request->address_zip),
            'customerAddress' => $request->customerAddress,
            'ams_address' => 'Y',
            'entryBy' => 'admin.filing',
            'entryDate' => $dateTime,
            'partition_id' => 1124,
            'customerAddressFax' => '',
            'address_state' => '',
            'delete_by' => '',
            'delete_date' => '0000-00-00 00:00:00',
        ];

        if ($isUpdate) {
            $data['update_by'] = 'admin.filing';
            $data['update_date'] = $dateTime;
        } else {
            $data['update_by'] = '';
            $data['update_date'] = '0000-00-00 00:00:00';
        }



        // Insert or update
        $customer = CustomerAddress::updateOrCreate(
            ['rowId' => $request->rowId],
            $data
        );

        return response()->json([
            'status' => 'success',
            'message' => $isUpdate ? 'Customer updated successfully' : 'Customer created successfully',
            'data' => $customer
        ]);
    }

    public function show($id) {}

    public function edit($id) {}

    public function update(Request $request, $id) {}

    public function destroy($id) {}
}

<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Http\Resources\V1\CoustomerResource;
use App\Http\Resources\V1\CoustomerCollection;
use App\Filters\V1\CustomerFilter;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $filter = new CustomerFilter();
        $filterItmes = $filter->transform($request); //[['column', 'operator', 'value']]

        $includeInvoices = $request->query('includeInvoices');
        $customers = Customer::where($filterItmes);

        if ($includeInvoices) {
            $customers = $customers->with('invoices');
        }

        return new CoustomerCollection($customers->paginate()->appends($request->query()));

        // //using this index method get all custormers data
        // $all_data = Customer::all();
        // //$all_data = Customer::with('invoices')->get();
        // return response()->json($all_data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //using this show method get single custormer data
        $includeInvoices = Request()->query('includeInvoices');
        if ($includeInvoices) {
            return new CoustomerResource($customer->loadMissing('invoices'));
        }
        return new CoustomerResource($customer);
        return response()->json($customer, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}

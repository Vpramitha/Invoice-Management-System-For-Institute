<?php

namespace App\Http\Controllers;

use App\Models\Broker;
use Illuminate\Http\Request;

class BrokerController extends Controller
{
    public function index()
    {
        $brokers = Broker::paginate(10);
        return view('brokers.index', compact('brokers')); // Pass the brokers data to the view
    }

    public function create()
    {
        return view('brokers.create'); // Pass the brokers data to the view
    }


    public function edit(Broker $broker)
    {
        return view('brokers.edit', compact('broker'));
    }

    public function store(Request $request)
    {
        try {
            // Validate the input data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:brokers',
                'nic' => 'required|string|unique:brokers',
                'mobile_number' => 'required|string|max:20',  // Ensure it matches the form field
            ]);

            // If validation passes, create the broker
            Broker::create($validated);

            // Redirect to the brokers index with success message
            return redirect()->route('brokers.index')->with('success', 'Broker created successfully!');
        } catch (\Exception $e) {
            // In case of any error while creating the broker, redirect back to create page with error message
            return redirect()->route('brokers.create')->with('error', 'Failed to create broker. Please try again. ' . $e->getMessage());
        }
    }




    public function show(Broker $broker)
    {
        return response()->json($broker);
    }

    public function update(Request $request, Broker $broker)
    {
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'nic' => 'required|string|max:15',
                'mobile_number' => 'required|string|max:15',
            ]);

            // Update the broker
            $broker->update($request->all());

            // Redirect with success message
            return redirect()->route('brokers.index')->with('success', 'Broker updated successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation exceptions specifically
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle general exceptions
            return redirect()->route('brokers.edit', $broker->id)->with('error', 'An error occurred while updating the broker. Please try again later.');
        }
    }


    public function destroy(Broker $broker)
    {
        try {
            $broker->delete();
            return redirect()->route('brokers.index')->with('success', 'Broker deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('brokers.index')->with('error', 'An error occurred while deleting the broker.');
        }
    }
}

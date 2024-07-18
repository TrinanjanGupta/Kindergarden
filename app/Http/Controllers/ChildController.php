<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Child;
use App\Models\PickupPerson;
use Illuminate\Support\Facades\Storage;

class ChildController extends Controller
{
    public function create()
    {
        return view('child.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'class' => 'required|string',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'zip_code' => 'required|digits:6',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:1024|dimensions:min_width=100,min_height=100',
            'pickup_people' => 'required|array|min:1|max:6',
            'pickup_people.*.name' => 'required|string|max:255',
            'pickup_people.*.relation' => 'required|string|in:Father,Mother,Brother,Sister,Grand Father,Grand Mother',
            'pickup_people.*.contact_no' => 'required|digits:10',
        ]);

        // Create a new child record
        $child = new Child();
        $child->name = $validatedData['name'];
        $child->dob = $validatedData['dob'];
        $child->class = $validatedData['class'];
        $child->address = $validatedData['address'];
        $child->city = $validatedData['city'];
        $child->state = $validatedData['state'];
        $child->country = $validatedData['country'];
        $child->zip_code = $validatedData['zip_code'];

        // Handle file upload if a photo is provided
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // Store the file in the public disk under 'uploads' directory
            $path = $file->storeAs('uploads', $filename, 'public');
            // Save the filename to the database
            $child->photo = $filename;
        }

        $child->save();

        // Save pickup people
        foreach ($validatedData['pickup_people'] as $person) {
            $pickupPerson = new PickupPerson();
            $pickupPerson->child_id = $child->id;
            $pickupPerson->name = $person['name'];
            $pickupPerson->relation = $person['relation'];
            $pickupPerson->contact_no = $person['contact_no'];
            $pickupPerson->save();
        }

        // Fetch the saved pickup people to pass to the thank_you view
        $pickupPeople = PickupPerson::where('child_id', $child->id)->get();

        return view('child.thank_you', ['child' => $child, 'pickupPeople' => $pickupPeople]);
    }
}

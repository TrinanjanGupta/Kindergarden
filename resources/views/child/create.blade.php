<!DOCTYPE html>
<html>
<head>
    <title>Child Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.3/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .pickup-person {
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
            padding: 10px;
            border-radius: 8px;
        }
        .pickup-person label {
            font-weight: bold;
        }
        .required-star::after {
            content: '*';
            color: red;
            margin-left: 4px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mb-4">Register Child</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="childForm" method="POST" action="{{ route('child.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name" class="required-star">Child Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="dob" class="required-star">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="class" class="required-star">Class</label>
                <select name="class" id="class" class="form-control" required>
                    <option value="">Select Class</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}">Class {{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="address" class="required-star">Address</label>
                <input type="text" name="address" id="address" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="city" class="required-star">City</label>
                <input type="text" name="city" id="city" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="state" class="required-star">State</label>
                <input type="text" name="state" id="state" class="form-control" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="country" class="required-star">Country</label>
                <input type="text" name="country" id="country" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="zip_code" class="required-star">Zip Code</label>
                <input type="text" name="zip_code" id="zip_code" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" id="photo" class="form-control-file">
        </div>
        <div id="pickup-people">
            <div class="pickup-person">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="pickup_people[0][name]" class="required-star">Pickup Person Name</label>
                        <input type="text" name="pickup_people[0][name]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pickup_people[0][relation]" class="required-star">Relation</label>
                        <select name="pickup_people[0][relation]" class="form-control" required>
                            <option value="">Select Relation</option>
                            <option value="Father">Father</option>
                            <option value="Mother">Mother</option>
                            <option value="Brother">Brother</option>
                            <option value="Sister">Sister</option>
                            <option value="Grand Father">Grand Father</option>
                            <option value="Grand Mother">Grand Mother</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="pickup_people[0][contact_no]" class="required-star">Contact No</label>
                        <input type="text" name="pickup_people[0][contact_no]" class="form-control" required>
                    </div>
                </div>
                <button type="button" class="btn btn-danger remove-person">Remove</button>
            </div>
        </div>
        <button type="button" id="add-person" class="btn btn-primary mt-2">Add More</button>
        <button type="submit" class="btn btn-success mt-2">Submit</button>
    </form>
</div>

<script>
    var personCount = 1;
    $('#add-person').click(function() {
        if (personCount < 6) {
            var newPerson = `
                <div class="pickup-person">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="pickup_people[${personCount}][name]" class="required-star">Pickup Person Name</label>
                            <input type="text" name="pickup_people[${personCount}][name]" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pickup_people[${personCount}][relation]" class="required-star">Relation</label>
                            <select name="pickup_people[${personCount}][relation]" class="form-control" required>
                                <option value="">Select Relation</option>
                                <option value="Father">Father</option>
                                <option value="Mother">Mother</option>
                                <option value="Brother">Brother</option>
                                <option value="Sister">Sister</option>
                                <option value="Grand Father">Grand Father</option>
                                <option value="Grand Mother">Grand Mother</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pickup_people[${personCount}][contact_no]" class="required-star">Contact No</label>
                            <input type="text" name="pickup_people[${personCount}][contact_no]" class="form-control" required>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger remove-person">Remove</button>
                </div>
            `;
            $('#pickup-people').append(newPerson);
            personCount++;
        }
    });

    $(document).on('click', '.remove-person', function() {
        $(this).closest('.pickup-person').remove();
        personCount--;
    });

    $('#childForm').validate({
        rules: {
            name: "required",
            dob: "required",
            class: "required",
            address: "required",
            city: "required",
            state: "required",
            country: "required",
            zip_code: {
                required: true,
                digits: true,
                minlength: 6,
                maxlength: 6
            },
            
            'pickup_people[0][name]': "required",
            'pickup_people[0][relation]': "required",
            'pickup_people[0][contact_no]': {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            }
        },
        messages: {
            name: "Please enter the child's name",
            dob: "Please enter the date of birth",
            class: "Please select the class",
            address: "Please enter the address",
            city: "Please enter the city",
            state: "Please enter the state",
            country: "Please enter the country",
            zip_code: {
                required: "Please enter the zip code",
                digits: "Please enter only digits",
                minlength: "Zip code must be 6 digits",
                maxlength: "Zip code must be 6 digits"
            },
            
            'pickup_people[0][name]': "Please enter the pickup person's name",
            'pickup_people[0][relation]': "Please select the relation",
            'pickup_people[0][contact_no]': {
                required: "Please enter the contact number",
                digits: "Please enter only digits",
                minlength: "Contact number must be 10 digits",
                maxlength: "Contact number must be 10 digits"
            }
        },
        errorPlacement: function(error, element) {
            error.addClass('text-danger');
            error.insertAfter(element);
        }
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Thank You</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: white;
        }
        .card-title {
            color: #007bff;
        }
        .list-group-item {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header text-center">
            Thank You!
        </div>
        <div class="card-body">
            <h5 class="card-title text-center">Registration Successful</h5>
            <p class="card-text text-center">Thank you for registering the child. Here are the details:</p>
            <ul class="list-group mb-3">
                <li class="list-group-item"><strong>Name:</strong> {{ $child->name }}</li>
                <li class="list-group-item"><strong>Date of Birth:</strong> {{ $child->dob }}</li>
                <li class="list-group-item"><strong>Class:</strong> {{ $child->class }}</li>
                <li class="list-group-item"><strong>Address:</strong> {{ $child->address }}</li>
                <li class="list-group-item"><strong>City:</strong> {{ $child->city }}</li>
                <li class="list-group-item"><strong>State:</strong> {{ $child->state }}</li>
                <li class="list-group-item"><strong>Country:</strong> {{ $child->country }}</li>
                <li class="list-group-item"><strong>Zip Code:</strong> {{ $child->zip_code }}</li>
                <li class="list-group-item">
                    <strong>Photo:</strong><br>
                    @if (!empty($child->photo))
                        <img src="{{ asset('storage/uploads/' . $child->photo) }}" alt="{{ $child->name }}" class="img-fluid mt-2" width="100">
                    @else
                        <p>No photo available</p>
                    @endif
                </li>
            </ul>
            <hr>
            <h5 class="text-center">Pickup People</h5>
            <ul class="list-group">
                @foreach ($pickupPeople as $person)
                <li class="list-group-item">
                    <strong>Name:</strong> {{ $person->name }}<br>
                    <strong>Relation:</strong> {{ $person->relation }}<br>
                    <strong>Contact No:</strong> {{ $person->contact_no }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

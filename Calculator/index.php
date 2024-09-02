<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .selectdiv select{
            width: 40%;
        }
        .selectdiv input{
            width: 20%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
    <form id="userForm">
            <div class="mb-3">
                <label for="PersonNumber" class="form-label">Enter Number of Adults (Only)</label>
                <input type="number" class="form-control" id="PersonNumber" name="persons" required>
            </div>
            <div class="mb-3">
                <label for="dateVisit" class="form-label">Enter Date</label>
                <input type="date" class="form-control" id="dateVisit" name="date" required>
            </div>

            <!-- Hotel Makkah 1st Stay -->
            <div class=" mb-3">
                <label for="hotelMakkah1stay" class="form-label">Select Makkah Hotel (First Stay)</label>
                <div class="d-flex selectdiv">
                    <select id="hotelMakkah1stay" name="hotelMakkah1" class="form-control w-60">
                       
                    </select>
                    <input type="number" class="form-control" name="nightMakkah1" placeholder="Enter Nights">
                    <input type="number" class="form-control" name="roomMakkah1" placeholder="Enter Rooms">
                </div>
            </div>

            <!-- Hotel Madinah 2nd Stay -->
            <div class="mb-3">
                <label for="hotelMaddinah2stay" class="form-label">Select Madinah Hotel (Second Stay)</label>
                <div class="d-flex selectdiv">
                    <select id="hotelMaddinah2stay" name="hotelMaddinah2" class="form-control w-60">
                       
                    </select>
                    <input type="number" class="form-control" name="nightMaddinah2" placeholder="Enter Nights">
                    <input type="number" class="form-control" name="roomMaddinah2" placeholder="Enter Rooms">
                </div>
            </div>

            <!-- Hotel Makkah 3rd Stay -->
            <div class="mb-3">
                <label for="hotelMakkah3stay" class="form-label">Select Makkah Hotel (Third Stay)</label>
                <div class="d-flex selectdiv">
                    <select id="hotelMakkah3stay" name="hotelMakkah3" class="form-control w-60">
                    
                    </select>
                    <input type="number" class="form-control" name="nightMakkah3" placeholder="Enter Nights">
                    <input type="number" class="form-control" name="roomMakkah3" placeholder="Enter Rooms">
                </div>
            </div>

            <div class="mb-3">
                <label for="flightType" class="form-label">Select Flight Type</label>
                <select id="flightType" name="flightType" class="form-control">
                    <option value="Direct Flight">Direct Flight</option>
                    <option value="Connected Flight">Connected Flight</option>
                </select>
            </div>
            <button type="submit" id="SubmitButton" class="btn btn-primary">Submit</button>
            <button type="button" id="deleteButton"   class="btn btn-danger">Delete Record</button>
        </form>
 
<!-- Table to display results -->

<div class="container">
    <div class="row">
        <div class="col-lg-6">
        <h5 id="ArrivalDate">Arrival Date:</h5>
        <h5 id="NumberofAdults">Number OF Adults:</h5>
        <h5 id="flightTypeResult">Flight Type:</h5>
    <h5 id="PerPerson">Total Coast of One Person: Rs  </h5>
    <h5 id="TotalPerson">Total Coast of Whole Trip: Rs </h5>
        </div>
    
        <div class="col-lg-6">
        <table id="calculationTable" class="table">
    <thead>
        <tr>
            <th scope="col">Hotel Name</th>
            <th scope="col">Total Rooms</th>
            <th scope="col">Total Nights</th>
         
        </tr>
    </thead>
    <tbody id="calculationbody">
        <!-- Data will be populated here by JavaScript -->
    </tbody>
</table>
        </div>
    </div>
  
</div>
        
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
$(document).ready(function() {
    
    $('#deleteButton').show();


    // Function to fetch hotels and populate select elements
    function fetchHotels(location, selectId) {
        $.ajax({
            url: 'userprocess.php',
            type: 'GET',
            data: { location: location },
            success: function(response) {
                try {
                    let hotels = JSON.parse(response);
                    let options = '';
                    $.each(hotels, function(index, hotel) {
                        options += `<option value="${hotel.hotel_name}">${hotel.hotel_name} - ${hotel.distance} km</option>`;
                    });
                    $(selectId).html(options);
                } catch (e) {
                    console.error('Failed to parse JSON response:', e);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
                alert('Failed to fetch hotels.');
            }
        });
    }

    // Call fetch functions when the page loads
    fetchHotels('makkah', '#hotelMakkah1stay');
    fetchHotels('makkah', '#hotelMakkah3stay');
    fetchHotels('madinah', '#hotelMaddinah2stay');

    var currentUUID = localStorage.getItem('currentUUID');

    if(!currentUUID){
         // Handle userForm submission
    $('#userForm').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        // First AJAX request to calculate.php
        $.ajax({
            url: 'calculate.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Data inserted successfully.');
                     $('#SubmitButton').hide();
                     $('#deleteButton').show();

                 
                   
                    // Proceed with userprocess.php for further processing
                    $.ajax({
                        url: 'userprocess.php',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            var result = JSON.parse(response);

                            if (result.success) {
                                $('#response').html('<div class="alert alert-success">' + result.success + '</div>');
                                $('#deleteButton').show();

                                // Store the UUID and fetch data
                                if (result.uuid) {
                                    localStorage.setItem('currentUUID', result.uuid);
                                 
                                    fetchData();
                                }
                            } else {
                                $('#response').html('<div class="alert alert-danger">' + result.error + '</div>');
                            }
                        },
                        error: function(xhr, status, error) {
                            $('#response').html('<div class="alert alert-danger">AJAX Error: ' + error + '</div>');
                        }
                    });
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('An error occurred while processing the form. Please try again.');
            }
        });
    });
    }else{
        alert('Data is already inserted .');
    }
   
    fetchData()
    // Function to fetch data using the stored UUID
    function fetchData() {
        var currentUUID = localStorage.getItem('currentUUID');
        if (currentUUID) {
            $.ajax({
                url: 'fetchcalculation.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    uuid: currentUUID // Include the UUID in the request
                },
                success: function(response) {
                    if (response.success) {
                        let data = response.data;
                        let tableHtml = '';
                         
                        // Makkah Hotel (First Stay)
                        if (data.hotelMakkah1Stay) {
                            tableHtml += `<tr>
                                <td>${data.hotelMakkah1Stay.hotel || ''}</td>
                                <td>${data.hotelMakkah1Stay.rooms || ''}</td>
                                <td>${data.hotelMakkah1Stay.nights || ''}</td>
                            </tr>`;
                        }

                        // Madinah Hotel (Second Stay)
                        if (data.hotelMaddinah2Stay) {
                            tableHtml += `<tr>
                                <td>${data.hotelMaddinah2Stay.hotel || ''}</td>
                                <td>${data.hotelMaddinah2Stay.rooms || ''}</td>
                                <td>${data.hotelMaddinah2Stay.nights || ''}</td>
                            </tr>`;
                        }

                        // Makkah Hotel (Third Stay)
                        if (data.hotelMakkah3Stay) {
                            tableHtml += `<tr>
                                <td>${data.hotelMakkah3Stay.hotel || ''}</td>
                                <td>${data.hotelMakkah3Stay.rooms || ''}</td>
                                <td>${data.hotelMakkah3Stay.nights || ''}</td>
                            </tr>`;
                        }

                        // Tickets (Flight Type)
                 $("#flightTypeResult").append(data.flightType);



                        // Total Per Person Price
                $('#PerPerson').append(data.totalPerPerson);
                         
          
                        // Total Price
                $('#TotalPerson').append(data.totalPrice);
                        

                ///Persons
                $('#NumberofAdults').append(data.persons);
                        
                ///Date
                $('#ArrivalDate').append(data.date);
 

                        $('#calculationbody').html(tableHtml); // Replace 'calculationTable' with the actual ID of your table element
                    } else {
                        $('#response').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#response').html('<div class="alert alert-danger">AJAX Error: ' + error + '</div>');
                }
            });
        } else {
            $('#response').html('<div class="alert alert-warning">No UUID available for fetching data.</div>');
        }
    }

 
    // Handle delete button click
    $('#deleteButton').on('click', function() {
        var recordUUID = localStorage.getItem('currentUUID'); // Get the UUID from localStorage

        if (!recordUUID) {
            alert('No UUID available for deletion.');
            return;
        }

        if (confirm('Are you sure you want to delete this record?')) {
            $.ajax({
                url: 'delete.php', // Server-side script for deletion
                type: 'POST',
                data: { uuid: recordUUID },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Record deleted successfully.');
                        fetchData()
                     $('#SubmitButton').show();
                    $('#deleteButton').hide();

                        // Optionally, remove the row from the table or refresh the page
                    document.querySelector('#calculationbody').style.display="none";
                        // Clear the UUID from localStorage if needed
                        localStorage.removeItem('currentUUID');
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('An error occurred while deleting the record. Please try again.');
                }
            });
        }
    });
});
</script>

 
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Price Management</title>
    <!-- Include Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Include Bootstrap CSS for Modal -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-12">
        <div class="mb-3">
            <label for="hotelName" class="form-label">Makkah Hotels</label>
            <select id="hotelName" class="form-control select2" style="width: 100%;"></select>
        </div>
        <button type="button" id="viewBtn" class="btn btn-info">View</button>
        <button type="button" id="editBtn" class="btn btn-warning">Edit</button>
        <button type="button" id="addNewBtn" class="btn btn-success">Add New</button>

        <!-- View/ Edit Modal -->
        <div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="priceModalLabel">Manage Prices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="priceForm">
                    <div class="mb-3">
                        <label for="hotelNameDropdown" class="form-label">Hotel Name</label>
                        <select id="hotelNameDropdown" class="form-control" style="width: 100%;"></select>
                    </div>
                    <input type="hidden" id="hotelId" name="hotelId">
                    <div class="mb-3">
                        <label for="distance" class="form-label">Distance (meter)</label>
                        <input type="number" class="form-control" id="distance" name="distance" placeholder="Distance from city center">
                    </div>
                    <div class="mb-3">
                        <label for="hotelNameInput" class="form-label">Hotel Name</label>
                        <input type="text" class="form-control" id="hotelNameInput" name="hotelName">
                    </div>

                    <!-- Monthly Prices -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="janPrice" class="form-label">January</label>
                            <input type="number" class="form-control" id="janPrice" name="janPrice" placeholder="Price for January">
                        </div>
                        <div class="col-md-6">
                            <label for="febPrice" class="form-label">February</label>
                            <input type="number" class="form-control" id="febPrice" name="febPrice" placeholder="Price for February">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="marPrice" class="form-label">March</label>
                            <input type="number" class="form-control" id="marPrice" name="marPrice" placeholder="Price for March">
                        </div>
                        <div class="col-md-6">
                            <label for="aprPrice" class="form-label">April</label>
                            <input type="number" class="form-control" id="aprPrice" name="aprPrice" placeholder="Price for April">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="mayPrice" class="form-label">May</label>
                            <input type="number" class="form-control" id="mayPrice" name="mayPrice" placeholder="Price for May">
                        </div>
                        <div class="col-md-6">
                            <label for="junPrice" class="form-label">June</label>
                            <input type="number" class="form-control" id="junPrice" name="junPrice" placeholder="Price for June">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="julPrice" class="form-label">July</label>
                            <input type="number" class="form-control" id="julPrice" name="julPrice" placeholder="Price for July">
                        </div>
                        <div class="col-md-6">
                            <label for="augPrice" class="form-label">August</label>
                            <input type="number" class="form-control" id="augPrice" name="augPrice" placeholder="Price for August">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sepPrice" class="form-label">September</label>
                            <input type="number" class="form-control" id="sepPrice" name="sepPrice" placeholder="Price for September">
                        </div>
                        <div class="col-md-6">
                            <label for="octPrice" class="form-label">October</label>
                            <input type="number" class="form-control" id="octPrice" name="octPrice" placeholder="Price for October">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="novPrice" class="form-label">November</label>
                            <input type="number" class="form-control" id="novPrice" name="novPrice" placeholder="Price for November">
                        </div>
                        <div class="col-md-6">
                            <label for="decPrice" class="form-label">December</label>
                            <input type="number" class="form-control" id="decPrice" name="decPrice" placeholder="Price for December">
                        </div>
                    </div>

                    <button type="submit" id="submitBtn" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


        <!-- Add New Modal -->
        <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewModalLabel">Add New Hotel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewForm">
                    <div class="mb-3">
                        <label for="newHotelName" class="form-label">Hotel Name</label>
                        <input type="text" class="form-control" id="newHotelName" name="hotelName" placeholder="Hotel Name">
                    </div>
                    <div class="mb-3">
                        <label for="distance" class="form-label">Distance (meter)</label>
                        <input type="number" class="form-control" id="distance" name="distance" placeholder="Distance from city center">
                    </div>

                    <!-- Month Prices -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newJanPrice" class="form-label">January Price</label>
                            <input type="number" class="form-control" id="newJanPrice" name="janPrice" placeholder="Price for January">
                        </div>
                        <div class="col-md-6">
                            <label for="newFebPrice" class="form-label">February Price</label>
                            <input type="number" class="form-control" id="newFebPrice" name="febPrice" placeholder="Price for February">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newMarPrice" class="form-label">March Price</label>
                            <input type="number" class="form-control" id="newMarPrice" name="marPrice" placeholder="Price for March">
                        </div>
                        <div class="col-md-6">
                            <label for="newAprPrice" class="form-label">April Price</label>
                            <input type="number" class="form-control" id="newAprPrice" name="aprPrice" placeholder="Price for April">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newMayPrice" class="form-label">May Price</label>
                            <input type="number" class="form-control" id="newMayPrice" name="mayPrice" placeholder="Price for May">
                        </div>
                        <div class="col-md-6">
                            <label for="newJunPrice" class="form-label">June Price</label>
                            <input type="number" class="form-control" id="newJunPrice" name="junPrice" placeholder="Price for June">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newJulPrice" class="form-label">July Price</label>
                            <input type="number" class="form-control" id="newJulPrice" name="julPrice" placeholder="Price for July">
                        </div>
                        <div class="col-md-6">
                            <label for="newAugPrice" class="form-label">August Price</label>
                            <input type="number" class="form-control" id="newAugPrice" name="augPrice" placeholder="Price for August">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newSepPrice" class="form-label">September Price</label>
                            <input type="number" class="form-control" id="newSepPrice" name="sepPrice" placeholder="Price for September">
                        </div>
                        <div class="col-md-6">
                            <label for="newOctPrice" class="form-label">October Price</label>
                            <input type="number" class="form-control" id="newOctPrice" name="octPrice" placeholder="Price for October">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newNovPrice" class="form-label">November Price</label>
                            <input type="number" class="form-control" id="newNovPrice" name="novPrice" placeholder="Price for November">
                        </div>
                        <div class="col-md-6">
                            <label for="newDecPrice" class="form-label">December Price</label>
                            <input type="number" class="form-control" id="newDecPrice" name="decPrice" placeholder="Price for December">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Hotel</button>
                </form>
            </div>
        </div>
    </div>
</div>

        </div>

        <div class="col-lg-12 mt-5">
        <div class="mb-3">
            <label for="hotelMadinaNameSelect" class="form-label">Madina Hotels</label>
            <select id="hotelNameSelect" class="form-control " style="width: 100%;"></select>
        </div>
        <button type="button" id="viewMadinaBtn" class="btn btn-info">View</button>
        <button type="button" id="editMadinaBtn" class="btn btn-warning">Edit</button>
        <button type="button" id="addNewMadinaBtn" class="btn btn-success">Add New</button>

        <!-- View/ Edit Modal for Hotel Madina -->
        <div class="modal fade" id="madinaManagementModal" tabindex="-1" aria-labelledby="madinaManagementModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="madinaManagementModalLabel">Manage Hotel Madina Prices</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="madinaManagementForm">
                    <div class="mb-3">
                        <label for="madinaHotelSelect" class="form-label">Hotel Madina Name</label>
                        <select id="madinaHotelSelect" class="form-control" style="width: 100%;"></select>
                    </div>
                    <input type="hidden" id="madinaHotelIdInput" name="hotelIdMadina">
                    <div class="mb-3">
                        <label for="madinaDistanceInput" class="form-label">Distance (meters)</label>
                        <input type="number" class="form-control" id="madinaDistanceInput" name="distance" placeholder="Distance from city center">
                    </div>
                    <div class="mb-3">
                        <label for="madinaHotelNameInput" class="form-label">Hotel Madina Name</label>
                        <input type="text" class="form-control" id="madinaHotelNameInput" name="hotelName">
                    </div>

                    <!-- Month Prices -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="madinaJanPriceInput" class="form-label">January Price</label>
                            <input type="number" class="form-control" id="madinaJanPriceInput" name="janPrice" placeholder="Price for January">
                        </div>
                        <div class="col-md-6">
                            <label for="madinaFebPriceInput" class="form-label">February Price</label>
                            <input type="number" class="form-control" id="madinaFebPriceInput" name="febPrice" placeholder="Price for February">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="madinaMarPriceInput" class="form-label">March Price</label>
                            <input type="number" class="form-control" id="madinaMarPriceInput" name="marPrice" placeholder="Price for March">
                        </div>
                        <div class="col-md-6">
                            <label for="madinaAprPriceInput" class="form-label">April Price</label>
                            <input type="number" class="form-control" id="madinaAprPriceInput" name="aprPrice" placeholder="Price for April">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="madinaMayPriceInput" class="form-label">May Price</label>
                            <input type="number" class="form-control" id="madinaMayPriceInput" name="mayPrice" placeholder="Price for May">
                        </div>
                        <div class="col-md-6">
                            <label for="madinaJunPriceInput" class="form-label">June Price</label>
                            <input type="number" class="form-control" id="madinaJunPriceInput" name="junPrice" placeholder="Price for June">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="madinaJulPriceInput" class="form-label">July Price</label>
                            <input type="number" class="form-control" id="madinaJulPriceInput" name="julPrice" placeholder="Price for July">
                        </div>
                        <div class="col-md-6">
                            <label for="madinaAugPriceInput" class="form-label">August Price</label>
                            <input type="number" class="form-control" id="madinaAugPriceInput" name="augPrice" placeholder="Price for August">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="madinaSepPriceInput" class="form-label">September Price</label>
                            <input type="number" class="form-control" id="madinaSepPriceInput" name="sepPrice" placeholder="Price for September">
                        </div>
                        <div class="col-md-6">
                            <label for="madinaOctPriceInput" class="form-label">October Price</label>
                            <input type="number" class="form-control" id="madinaOctPriceInput" name="octPrice" placeholder="Price for October">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="madinaNovPriceInput" class="form-label">November Price</label>
                            <input type="number" class="form-control" id="madinaNovPriceInput" name="novPrice" placeholder="Price for November">
                        </div>
                        <div class="col-md-6">
                            <label for="madinaDecPriceInput" class="form-label">December Price</label>
                            <input type="number" class="form-control" id="madinaDecPriceInput" name="decPrice" placeholder="Price for December">
                        </div>
                    </div>

                    <button type="submit" id="madinaFormSubmitBtn" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>


        <!-- Add New Modal for Hotel Madina -->
 <div class="modal fade" id="addNewMadinaModal" tabindex="-1" aria-labelledby="addNewMadinaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNewMadinaModalLabel">Add New Hotel Madina</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addNewMadinaForm">
                    <div class="mb-3">
                        <label for="newMadinaHotelNameInput" class="form-label">Hotel Madina Name</label>
                        <input type="text" class="form-control" id="newMadinaHotelNameInput" name="hotelName2" placeholder="Hotel Name">
                    </div>
                    <div class="mb-3">
                        <label for="newMadinaDistanceInput" class="form-label">Distance (meters)</label>
                        <input type="number" class="form-control" id="newMadinaDistanceInput" name="distance2" placeholder="Distance from city center">
                    </div>
                    
                    <!-- Month Prices -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newMadinaJanPriceInput" class="form-label">January Price</label>
                            <input type="number" class="form-control" id="newMadinaJanPriceInput" name="janPrice2" placeholder="Price for January">
                        </div>
                        <div class="col-md-6">
                            <label for="newMadinaFebPriceInput" class="form-label">February Price</label>
                            <input type="number" class="form-control" id="newMadinaFebPriceInput" name="febPrice2" placeholder="Price for February">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newMadinaMarPriceInput" class="form-label">March Price</label>
                            <input type="number" class="form-control" id="newMadinaMarPriceInput" name="marPrice2" placeholder="Price for March">
                        </div>
                        <div class="col-md-6">
                            <label for="newMadinaAprPriceInput" class="form-label">April Price</label>
                            <input type="number" class="form-control" id="newMadinaAprPriceInput" name="aprPrice2" placeholder="Price for April">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newMadinaMayPriceInput" class="form-label">May Price</label>
                            <input type="number" class="form-control" id="newMadinaMayPriceInput" name="mayPrice2" placeholder="Price for May">
                        </div>
                        <div class="col-md-6">
                            <label for="newMadinaJunPriceInput" class="form-label">June Price</label>
                            <input type="number" class="form-control" id="newMadinaJunPriceInput" name="junPrice2" placeholder="Price for June">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newMadinaJulPriceInput" class="form-label">July Price</label>
                            <input type="number" class="form-control" id="newMadinaJulPriceInput" name="julPrice2" placeholder="Price for July">
                        </div>
                        <div class="col-md-6">
                            <label for="newMadinaAugPriceInput" class="form-label">August Price</label>
                            <input type="number" class="form-control" id="newMadinaAugPriceInput" name="augPrice2" placeholder="Price for August">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newMadinaSepPriceInput" class="form-label">September Price</label>
                            <input type="number" class="form-control" id="newMadinaSepPriceInput" name="sepPrice2" placeholder="Price for September">
                        </div>
                        <div class="col-md-6">
                            <label for="newMadinaOctPriceInput" class="form-label">October Price</label>
                            <input type="number" class="form-control" id="newMadinaOctPriceInput" name="octPrice2" placeholder="Price for October">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="newMadinaNovPriceInput" class="form-label">November Price</label>
                            <input type="number" class="form-control" id="newMadinaNovPriceInput" name="novPrice2" placeholder="Price for November">
                        </div>
                        <div class="col-md-6">
                            <label for="newMadinaDecPriceInput" class="form-label">December Price</label>
                            <input type="number" class="form-control" id="newMadinaDecPriceInput" name="decPrice2" placeholder="Price for December">
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add Hotel Madina</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    
<form id="otherThingsForm">
    <div class="row mt-5">
        <div class="col-lg-6">
            <label for="ticketDirect" class="form-label">Enter Price of Direct Flight Ticket (PP)</label>
            <input type="number" name="ticketDirect" class="form-control" id="ticketDirect" required>
        </div>

        <div class="col-lg-6">
            <label for="ticketConnect" class="form-label">Enter Price of Connected Flight Ticket (PP)</label>
            <input type="number" name="ticketConnect" class="form-control" id="ticketConnect" required>
        </div>

        <div class="col-lg-6 mt-3">
            <label for="visaPrice" class="form-label">Enter Price of Visa (Per Person)</label>
            <input type="number" name="visaPrice" class="form-control" id="visaPrice" required>
        </div>

        <div class="col-lg-6 mt-3">
            <label for="otherServices" class="form-label">Enter Price of Other Services Charges</label>
            <input type="number" name="otherServices" class="form-control" id="otherServices" required>
        </div>
    </div>
   
    <button class="btn btn-primary" id="actionButton" type="submit">Submit</button>
</form>




</div>
 

    </div>
    
         
    </div>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
   $(document).ready(function() {
    // Initialize Select2 for dropdowns
    $('.select2').select2({
        placeholder: "Select or enter hotel name",
        templateResult: formatHotelOption,
        templateSelection: formatHotelSelection
    });

    // Format options in the dropdown
    function formatHotelOption(option) {
        if (!option.id) {
            return option.text;
        }
        var distance = $(option.element).data('distance');
        return $('<span>' + option.text + ' (Distance: ' + distance + ' meters)</span>');
    }

    // Format selected option in the dropdown
    function formatHotelSelection(option) {
        if (!option.id) {
            return option.text;
        }
        var distance = $(option.element).data('distance');
        return $('<span>' + option.text + ' (Distance: ' + distance + ' meters)</span>');
    }

    // Populate dropdown with hotel names and distances
    function populateHotel() {
        $.ajax({
            url: 'get_hotels.php',
            type: 'GET',
            success: function(response) {
                console.log('AJAX Response:', response);
                try {
                    var hotels = JSON.parse(response);
                    $('#hotelName').empty();
                    $('#hotelNameDropdown').empty();

                    $.each(hotels, function(index, hotel) {
                        var optionText = hotel.hotel_name + ' (Distance: ' + hotel.distance + ' meters)';
                        $('#hotelName').append(new Option(hotel.hotel_name, hotel.id));
                        $('#hotelNameDropdown').append(new Option(optionText, hotel.id));
                        
                        // Set data-distance attribute for Select2 formatting
                        $('#hotelNameDropdown option:last').data('distance', hotel.distance);
                        $('#hotelName option:last').data('distance', hotel.distance);

                        console.log('Added hotel:', optionText);
                    });

                    $('#hotelName').trigger('change');
                    $('#hotelNameDropdown').trigger('change');
                } catch (e) {
                    console.error('Failed to parse JSON:', e);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    }

    populateHotel();

    // Update the hotel name dropdown with the selected hotel
    function updateHotelDropdown(hotelId) {
        $('#hotelNameDropdown').val(hotelId).trigger('change');
    }

    // Event listener for when the hotel dropdown selection changes
    $('#hotelNameDropdown').change(function() {
        var hotelId = $(this).val();
        if (hotelId) {
            $.ajax({
                url: 'get_prices.php',
                type: 'GET',
                data: { hotelId: hotelId },
                success: function(response) {
                    try {
                        var data = JSON.parse(response);
                        if (data) {
                            $('#hotelId').val(data.id);
                            $('#hotelNameInput').val(data.hotel_name);
                            $('#janPrice').val(data.jan_price);
                            $('#febPrice').val(data.feb_price);
                            $('#marPrice').val(data.mar_price);
                            $('#aprPrice').val(data.apr_price);
                            $('#mayPrice').val(data.may_price);
                            $('#junPrice').val(data.jun_price);
                            $('#julyPrice').val(data.jul_price);
                            $('#augPrice').val(data.aug_price);
                            $('#sepPrice').val(data.sep_price);
                            $('#octPrice').val(data.oct_price);
                            $('#novPrice').val(data.nov_price);
                            $('#decPrice').val(data.dec_price);
                            $('#distance').val(data.distance); // Set distance value
                        } else {
                            $('#hotelId').val('');
                            $('#hotelNameInput').val('');
                            $('#janPrice').val('');
                            $('#febPrice').val('');
                            $('#distance').val(''); // Clear distance field
                        }
                    } catch (e) {
                        console.error('Failed to parse JSON:', e);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            $('#hotelId').val('');
            $('#hotelNameInput').val('');
            $('#janPrice').val('');
            $('#febPrice').val('');
            $('#distance').val(''); // Clear distance field
        }
    });

    // Handle the View button click
    $('#viewBtn').click(function() {
        var hotelId = $('#hotelName').val();
        if (hotelId) {
            $('#priceModalLabel').text('View Prices');
            $('#submitBtn').hide(); // Hide the submit button in view mode
            updateHotelDropdown(hotelId); // Set dropdown in modal
            $('#priceModal').modal('show');
        }
    });

    // Handle the Edit button click
    $('#editBtn').click(function() {
        var hotelId = $('#hotelName').val();
        if (hotelId) {
            $('#priceModalLabel').text('Edit Prices');
            $('#submitBtn').show(); // Show the submit button in edit mode
            updateHotelDropdown(hotelId); // Set dropdown in modal
            $('#priceModal').modal('show');
        }
    });

    // Handle the Add New button click
    $('#addNewBtn').click(function() {
        $('#addNewModal').modal('show');
    });

    // Handle form submission for editing or adding new prices
    $('#priceForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert(result.success);
                        populateHotel(); // Refresh dropdown
                    } else {
                        alert(result.error);
                    }
                } catch (e) {
                    console.error('Failed to parse JSON:', e);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    // Handle form submission for adding a new hotel
    $('#addNewForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'process.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#addNewModal').modal('hide');
                alert('New hotel added successfully!');
                populateHotel(); // Refresh dropdown
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    // Initialize the modal without Select2 to avoid conflicts
    $('#priceModal').on('shown.bs.modal', function () {
        $('#hotelNameDropdown').trigger('change');
    });
});
    </script>
  <script>
  $(document).ready(function () {
    // Initialize Select2 for both Hotel and Hotel Madina dropdowns
    $('#hotelNameSelect').select2({
        placeholder: "Select or enter hotel name",
        templateResult: formatOption,
        templateSelection: formatSelection
    });

   

    // Function to format options in the dropdown
    function formatOption(option) {
        if (!option.id) {
            return option.text;
        }
        var distance = $(option.element).data('distance');
        return $('<span>' + option.text + ' (Distance: ' + distance + ' meters)</span>');
    }

    // Function to format selected option in the dropdown
    function formatSelection(option) {
        if (!option.id) {
            return option.text;
        }
        var distance = $(option.element).data('distance');
        return $('<span>' + option.text + ' (Distance: ' + distance + ' meters)</span>');
    }

    // Populate dropdowns with hotel names and distances
   function populateHotelDropdowns() {
    $.ajax({
        url: 'gethotelsma.php', // Ensure this URL is correct
        type: 'GET',
        success: function (response) {
            try {
                var hotels = JSON.parse(response);

                $('#hotelNameSelect').empty();
                $('#madinaHotelSelect').empty();

                $.each(hotels, function (index, hotelmadina) {
                    var optionText = hotelmadina.hotel_name + ' (Distance: ' + hotelmadina.distance + ' meters)';
                        $('#hotelNameSelect').append(new Option(hotelmadina.hotel_name, hotelmadina.id));
                        $('#madinaHotelSelect').append(new Option(optionText, hotelmadina.id));


                        // Set data-distance attribute for Select2 formatting
                       $('#madinaHotelSelect option:last').data('distance', hotelmadina.distance);
                        $('#hotelNameSelect option:last').data('distance', hotelmadina.distance);

                        console.log('Added hotel:', optionText);

                    
                });
              
                $('#hotelNameSelect').trigger('change');
                $('#madinaHotelSelect').trigger('change');
            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

populateHotelDropdowns();


    populateHotelDropdowns();

    // Event listener for dropdown changes
    $('#madinaHotelSelect').change(function () {
        const hotelId2 = $(this).val();

        if (hotelId2) {
            $.ajax({
                url: 'getpricesma.php',
                type: 'GET',
                data: { id: hotelId2 },
                success: function (response) {
                    try {
                        const data = JSON.parse(response);

                        if (data) {
                            $('#madinaHotelIdInput').val(data.id);
                            $('#madinaHotelNameInput').val(data.hotel_name);
                            $('#madinaJanPriceInput').val(data.jan_price || '');
                            $('#madinaFebPriceInput').val(data.feb_price || '');
                            $('#madinaMarPriceInput').val(data.mar_price || ''); // Ensure you handle all months
                            $('#madinaAprPriceInput').val(data.apr_price || '');
                            $('#madinaMayPriceInput').val(data.may_price || '');
                            $('#madinaJunPriceInput').val(data.jun_price || '');
                            $('#madinaJulPriceInput').val(data.jul_price || '');
                            $('#madinaAugPriceInput').val(data.aug_price || '');
                            $('#madinaSepPriceInput').val(data.sep_price || '');
                            $('#madinaOctPriceInput').val(data.oct_price || '');
                            $('#madinaNovPriceInput').val(data.nov_price || '');
                            $('#madinaDecPriceInput').val(data.dec_price || '');
                            $('#madinaDistanceInput').val(data.distance || '');
                        } else {
                            clearMadinaInputs();
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else {
            clearMadinaInputs();
        }
    });

    function clearMadinaInputs() {
        $('#madinaHotelIdInput').val('');
        $('#madinaHotelNameInput').val('');
        $('#madinaJanPriceInput').val('');
        $('#madinaFebPriceInput').val('');
        $('#madinaMarPriceInput').val('');
        $('#madinaAprPriceInput').val('');
        $('#madinaMayPriceInput').val('');
        $('#madinaJunPriceInput').val('');
        $('#madinaJulPriceInput').val('');
        $('#madinaAugPriceInput').val('');
        $('#madinaSepPriceInput').val('');
        $('#madinaOctPriceInput').val('');
        $('#madinaNovPriceInput').val('');
        $('#madinaDecPriceInput').val('');
        $('#madinaDistanceInput').val('');
    }

    function updateMadinaHotelDropdown(hotelId2) {
        $('#madinaHotelSelect').val(hotelId2).trigger('change');
    }

    // Handle View, Edit, and Add New buttons
    $('#viewMadinaBtn').click(function () {
        var hotelId2 = $('#hotelNameSelect').val();
        if (hotelId2) {
            $('#madinaManagementModalLabel').text('View Prices');
            $('#madinaFormSubmitBtn').hide();
            updateMadinaHotelDropdown(hotelId2);
            $('#madinaManagementModal').modal('show');
        }
    });

    $('#editMadinaBtn').click(function () {
        var hotelId = $('#hotelNameSelect').val();
        if (hotelId) {
            $('#madinaManagementModalLabel').text('Edit Prices');
            $('#madinaFormSubmitBtn').show();
            updateMadinaHotelDropdown(hotelId);
            $('#madinaManagementModal').modal('show');
        }
    });

    $('#addNewMadinaBtn').click(function () {
        $('#addNewMadinaModal').modal('show');
        $('#madinaHotelIdInput').val('');
    });

    // Handle form submission for Hotel Madina
    $('#madinaManagementForm').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: 'processmadina.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                try {
                    var result = JSON.parse(response);
                    if (result.success) {
                        alert(result.success);
                        populateHotelDropdowns();
                    } else {
                        alert(result.error);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });



    

    // Handle form submission for adding a new hotel
    $('#addNewMadinaForm').submit(function (e) {
        e.preventDefault();

        var formData2 = $(this).serialize();

        $.ajax({
            url: 'processmadina.php',
            type: 'POST',
            data: formData2,
            success: function (response) {
                $('#addNewMadinaModal').modal('hide');
                alert('New hotel madina added successfully!');
                populateHotelDropdowns();
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });

    $('#madinaManagementModal').on('shown.bs.modal', function () {
        $('#madinaHotelSelect').trigger('change');
    });
});

    </script>
    <script>
 
 $(document).ready(function() {
    // Fetch existing data when the page loads
    $.ajax({
        url: 'fetchotherform.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.exists) {
                // Populate the inputs with existing data
                $('#ticketDirect').val(response.ticketDirect);
                $('#ticketConnect').val(response.ticketConnect);
                $('#visaPrice').val(response.visaPrice);
                $('#otherServices').val(response.otherServices);

                // Disable the inputs
                disableInputs();

                // Change button text to "Update"
                $('#actionButton').text('Update');
            } 
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });

    // Handle form submission for insert/update
    $('#otherThingsForm').submit(function(e) {
        e.preventDefault();

        if ($('#actionButton').text() === 'Submit') {
            // Handle Insert
            $.ajax({
                url: 'otherform.php',
                type: 'POST',
                data: {
                    ticketDirect: $('#ticketDirect').val(),
                    ticketConnect: $('#ticketConnect').val(),
                    visaPrice: $('#visaPrice').val(),
                    otherServices: $('#otherServices').val(),
                },
                success: function(response) {
                    if (response.success) {
                        disableInputs(); // Disable inputs after successful insert
                        $('#actionButton').text('Update'); // Change text to Update
                        alert('Data inserted successfully!');
                    } else if (response.error) {
                        alert('Error:', response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        } else if ($('#actionButton').text() === 'Update') {
            // Enable inputs and change button to "Save"
            enableInputs();
            $('#actionButton').text('Save');
        } else if ($('#actionButton').text() === 'Save') {
            // Handle Update
            $.ajax({
                url: 'updateotherform.php',
                type: 'POST',
                data: {
                    ticketDirect: $('#ticketDirect').val(),
                    ticketConnect: $('#ticketConnect').val(),
                    visaPrice: $('#visaPrice').val(),
                    otherServices: $('#otherServices').val(),
                },
                success: function(response) {
                if (response.success) {
                 $('#saveButton').hide();
                 $('#submitButton').show().text('Update');
                disableInputs(); // Disable inputs after successful update
                alert(response.message); // This will now correctly display the success message
                 } else if (response.error) {
                  alert('Error: ' + response.error);
    }
},
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('An error occurred while updating the data. Please try again.');
                }
            });
        }
    });

    // Function to disable inputs
    function disableInputs() {
        $('#ticketDirect').prop('disabled', true);
        $('#ticketConnect').prop('disabled', true);
        $('#visaPrice').prop('disabled', true);
        $('#otherServices').prop('disabled', true);
    }

    // Function to enable inputs
    function enableInputs() {
        $('#ticketDirect').prop('disabled', false);
        $('#ticketConnect').prop('disabled', false);
        $('#visaPrice').prop('disabled', false);
        $('#otherServices').prop('disabled', false);
    }
});

    </script>
</body>
</html>

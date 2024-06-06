@extends('layouts.app')

@section('title', 'QR Solar Charger | QR Solar Charger')

@section('contents')

@livewireStyles
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@livewireStyles
<form id="l1form" action="http://192.168.8.125:80/l1receive" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="lockerone" value="L1 unlock">
</form>

<form id="l2form" action="http://192.168.8.125:80/l2receive" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="lockertwo" value="L2 unlock">
</form>

<form id="stop" action="http://192.168.8.125:80/stop" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="stop" value="stop">
</form>
<!-- Container for buttons aligned to the right side -->

<div style="display: flex; gap: 10px; margin-top: 20px; margin-bottom: 20px;">

    <select id="dropdownMenu" style="font-size: 20px; padding: 5px; border-radius: 10px; border: 1px solid #ccc;">
        <option value="" selected>Select an Area</option>
        <option value="Kandy">Kandy-City-Centre</option>
        <option value="Kandy">Kandy-Peradeniya-Bus_St</option>
        <option value="Kandy">Kandy-Mulgampola</option>
        <option value="Kandy">Kandy-Gelioya-City</option>
        <option value="Colombo">Colombo-Fort</option>
        <option value="Colombo">Colombo-Liberty-Plaza</option>
        <option value="Colombo">Colombo-Bus_St</option>
    </select>
    <button id="updateButton" style="font-size: 15px;">Update</button>

    <div style="margin-left: auto;">
        <button id="emergencyButton" style="font-size: 20px;" onclick="submitForm('stop');">Emergency Stop</button>
        <button id="l1Button" style="font-size: 20px;" onclick="submitForm('l1form');">L1</button>
        <button id="l2Button" style="font-size: 20px;" onclick="submitForm('l2form');">L2</button>
        <button id="l3Button" style="font-size: 20px;">L3</button>
        <button id="l4Button" style="font-size: 20px;">L4</button>
        <button id="l5Button" style="font-size: 20px;">L5</button>
    </div>


</div>

<script>
    document.getElementById('dropdownMenu').addEventListener('change', function() {
        var selectedValue = this.options[this.selectedIndex].value;
        if (selectedValue !== 'option1') {
            var randomInt = Math.floor(100 + Math.random() * 900); // Generate a random 3-digit number
            document.getElementById('deviceId').innerText = 'Device ID: ' + selectedValue + '-' + randomInt;
        } else {
            document.getElementById('deviceId').innerText = 'Device ID: ';
        }
    });
</script>

<script>
    function submitForm(l1form) {
        var form = $('#' + l1form);
        var url = form.attr('action');
        var data = form.serialize();

        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(response) {
                $('#responseMessage').text('Success: ' + response.message).css('color', 'green');
            },
            error: function(xhr) {
                $('#responseMessage').text('Fail: ' + xhr.responseText).css('color', 'red');
                window.location.href = window.location.href;
            }
        });
    }
    </script>

<!-- Custom Modal HTML -->
<div id="customModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Please confirm your decision</h2>
        </div>
        <div class="modal-footer">
            <button id="confirmYes" class="btn-yes">Yes</button>
            <button id="confirmNo" class="btn-no">No</button>
        </div>
    </div>
</div>

<div style="display: flex; justify-content: space-between; width: 100%; margin-top: 20px; gap: 10px;">
    <div style="border: 2px solid blue; border-radius: 10px; padding: 20px; width: calc(50% - 5px);">

        <div style="font-weight: bold; font-size: 30px;">Current temperature</div>
        <div style="margin-top: 10px;">
            <div style="display: inline-block; font-size: 25px;">Data reading : </div>
            <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="temperature_value">@livewire('temperature')</div>
        </div>

        <div style="margin-top: 10px;" id="current-time">{{ now()->format('Y-m-d H:i:s') }}</div>
    </div>

    <div style="border: 2px solid blue; border-radius: 10px; padding: 20px; width: calc(50% - 5px);">

        <div style="font-weight: bold; font-size: 30px;">Current voltage</div>
        <div style="margin-top: 10px;">
            <div style="display: inline-block; font-size: 25px;">Data reading : </div>
            <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="voltage_value">@livewire('voltage')</div>
        </div>

        <div style="margin-top: 10px;" id="current-time">{{ now()->format('Y-m-d H:i:s') }}</div>
    </div>
</div>

<div style="display: flex; justify-content: space-between; width: 100%; margin-top: 20px; gap: 10px;">
    <div style="border: 2px solid blue; border-radius: 10px; padding: 20px; width: calc(50% - 5px);">

        <div style="font-weight: bold; font-size: 30px;">Current Network status</div>
        <div style="margin-top: 10px;">
            <div style="display: inline-block; font-size: 25px;">Data reading : </div>
            <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="network_value">@livewire('networkstatus')</div>
        </div>

        <div style="margin-top: 10px;" id="current-time">{{ now()->format('Y-m-d H:i:s') }}</div>
    </div>

    <div style="border: 2px solid blue; border-radius: 10px; padding: 20px; width: calc(50% - 5px);">

        <div style="font-weight: bold; font-size: 30px;">Current user amount</div>
        <div style="margin-top: 10px;">
            <div style="display: inline-block; font-size: 25px;">Data reading : 1</div>
            {{-- <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="voltage_value">@livewire('temperature')</div> --}}
        </div>

        <div style="margin-top: 10px;" id="current-time">{{ now()->format('Y-m-d H:i:s') }}</div>
    </div>
</div>

<div style="margin-top: 10px;">
    <div style="display: inline-block; font-size: 25px;">Data reading :</div>
    <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="qrcode_value">@livewire('qrcode')</div>
</div>

<div style="margin-top: 10px;">
    <div style="display: inline-block; font-size: 25px;"><label id="deviceId"></label></div>
</div>

{{-- Tenperature exceed notofication --}}
<div id="popupModal" style="display: none; position: fixed; bottom: 20px; right: 20px; background-color: rgba(0, 0, 0, 0.7); color: white; padding: 10px; border-radius: 5px;">
    Temperature exceeds!
</div>


<script>

<h3 id="deviceId">Device ID: </h3>

    function showPopupModal() {
        var modal = document.getElementById('popupModal');
        modal.style.display = 'block'; // Show the modal

        setTimeout(function() {
            modal.style.display = 'none'; // Hide the modal after 5 seconds
        }, 5000); // 5000 milliseconds = 5 seconds
    }

    function checkTemperature() {
        var temperatureElement = document.getElementById('temperature_value');
        var temperature = parseInt(temperatureElement.textContent);

        if (temperature > 32) {
            showPopupModal(); // Show the popup modal if temperature exceeds 32
            temperatureElement.style.color = 'red'; // Change text color to red
        } else {
            temperatureElement.style.color = 'green'; // Change text color to green
        }
    }

    checkTemperature();

    function submitForm() {
            var form = document.getElementById('l1form');
            form.submit();

            showPopupModal('Request submitted successfully');
        }

    setInterval(function() {
        checkTemperature();
    }, 1000); // 1000 milliseconds = 1 second

    setInterval(function() {
        var currentTimeElement = document.getElementById('current-time');
        currentTimeElement.textContent = new Date().toISOString().slice(0, 19).replace('T', ' '); // Update time
    }, 1000);


    var btn = document.getElementById("emergencyButton");
    var modal = document.getElementById("customModal");
    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    document.getElementById('confirmYes').addEventListener('click', function() {
        alert('Emergency stop initiated!');
        modal.style.display = "none";
    });

    document.getElementById('confirmNo').addEventListener('click', function() {
        modal.style.display = "none";
    });
</script>

@livewireScripts
@endsection

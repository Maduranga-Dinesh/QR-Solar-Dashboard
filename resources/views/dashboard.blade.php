@extends('layouts.app')

@section('title', 'QR Solar Charger | QR Solar Charger')

@section('contents')

@livewireStyles

<form id="l1form" action="http://192.168.8.125:80/l1receive" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="lockerone" value="L1 unlock">
</form>

<!-- Container for buttons aligned to the right side -->

<div style="display: flex; gap: 10px; margin-top: 20px; margin-bottom: 20px;">

    <select id="dropdownMenu" style="font-size: 20px; padding: 5px; border-radius: 10px; border: 1px solid #ccc;">
        <option value="option1" selected>Select an Area</option>
        <option value="option2">Kandy-City-Centre</option>
        <option value="option3">Kandy-Peradeniya-Bus_St</option>
        <option value="option4">Kandy-Mulgampola</option>
        <option value="option5">Kandy-Gelioya-City</option>
        <option value="option6">Colombo-Fort</option>
        <option value="option7">Colombo-Liberty-Plaza</option>
        <option value="option8">Colombo-Bus_St</option>
    </select>
    <button id="updateButton" style="font-size: 15px;">Update</button>

    <div style="margin-left: auto;">
        <button id="emergencyButton" style="font-size: 20px;">Emergency Stop</button>
        <button id="l1Button" style="font-size: 20px;" onclick="document.getElementById('l1form').submit();">L1</button>
        <button id="l2Button" style="font-size: 20px;">L2</button>
        <button id="l3Button" style="font-size: 20px;">L3</button>
        <button id="l4Button" style="font-size: 20px;">L4</button>
        <button id="l5Button" style="font-size: 20px;">L5</button>
    </div>
</div>


<div>
    <div class="relative">
        <h1 class="font-bold text-2xl ml-0">Dashboard</h1>
        <hr class="mt-2 border-t border-gray-600">
    </div>
</div>

<!-- Custom Modal HTML -->
<div id="customModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close">&times;</span>
            <h2>Please confirm your decision</h2>
        </div>
        <div class="modal-body">
            <p>Current user count is 0.</p>
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
            <div style="display: inline-block; font-size: 25px;">Data reading :</div>
            <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="temperature_value">@livewire('temperature')</div>
        </div>

        <div style="margin-top: 10px;" id="current-time">{{ now()->format('Y-m-d H:i:s') }}</div>
    </div>

    <div style="border: 2px solid blue; border-radius: 10px; padding: 20px; width: calc(50% - 5px);">

        <div style="font-weight: bold; font-size: 30px;">Current voltage</div>
        <div style="margin-top: 10px;">
            <div style="display: inline-block; font-size: 25px;">Data reading :</div>
            <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="voltage_value">@livewire('temperature')</div>
        </div>

        <div style="margin-top: 10px;" id="current-time">{{ now()->format('Y-m-d H:i:s') }}</div>
    </div>
</div>

<div style="display: flex; justify-content: space-between; width: 100%; margin-top: 20px; gap: 10px;">
    <div style="border: 2px solid blue; border-radius: 10px; padding: 20px; width: calc(50% - 5px);">

        <div style="font-weight: bold; font-size: 30px;">Current Network status</div>
        <div style="margin-top: 10px;">
            <div style="display: inline-block; font-size: 25px;">Data reading :</div>
            <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="temperature_value">@livewire('temperature')</div>
        </div>

        <div style="margin-top: 10px;" id="current-time">{{ now()->format('Y-m-d H:i:s') }}</div>
    </div>

    <div style="border: 2px solid blue; border-radius: 10px; padding: 20px; width: calc(50% - 5px);">

        <div style="font-weight: bold; font-size: 30px;">Current user amount</div>
        <div style="margin-top: 10px;">
            <div style="display: inline-block; font-size: 25px;">Data reading :</div>
            <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="voltage_value">@livewire('temperature')</div>
        </div>

        <div style="margin-top: 10px;" id="current-time">{{ now()->format('Y-m-d H:i:s') }}</div>
    </div>
</div>

<div style="margin-top: 10px;">
    <div style="display: inline-block; font-size: 25px;">QR Data reading :</div>
    <div style="display: inline-block; margin-left: 3px; font-weight: bold; font-size: 25px;" id="qrcode_value">@livewire('qrcode')</div>
</div>

{{-- Tenperature exceed notofication --}}
<div id="popupModal" style="display: none; position: fixed; bottom: 20px; right: 20px; background-color: rgba(0, 0, 0, 0.7); color: white; padding: 10px; border-radius: 5px;">
    Temperature exceeds!
</div>


<script>
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

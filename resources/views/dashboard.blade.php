@extends('layouts.app')

@section('title', 'QR Solar Charger | QR Solar Charger')

@section('contents')
<div>
    <div class="relative">
        <h1 class="font-bold text-2xl ml-0">Dashboard</h1>
        <hr class="mt-2 border-t border-gray-600">
        <button id="emergencyButton" class="absolute bottom-6 right-0 m-3 px-4 py-2 rounded-full bg-red-600 text-white">Emergency Stop</button>
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

<!-- Custom Modal CSS -->
<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 20%;
        border-radius: 10px;
    }

    .modal-header{
        margin-left: 10px;
        align-content: center;
    }

    .modal-footer {
        padding: 10px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-body {
        text-align: center;
        padding: 10px 20px;
    }

    .modal-footer button {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-yes {
        margin-left: 30px;
        background-color: #244ccf;
        color: white;
    }

    .btn-no {
        margin-right:30px;
        background-color: #f81a0b;
        color: white;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>

<script>
    // Get the button that opens the modal
    var btn = document.getElementById("emergencyButton");

    // Get the modal
    var modal = document.getElementById("customModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Add event listener for Yes button
    document.getElementById('confirmYes').addEventListener('click', function() {
        alert('Emergency stop initiated!');
        modal.style.display = "none"; // Close the modal after action
    });

    // Add event listener for No button
    document.getElementById('confirmNo').addEventListener('click', function() {
        modal.style.display = "none"; // Close the modal
    });
</script>
<div>
    <livewire:devices.devices-index/>
</div>
@endsection

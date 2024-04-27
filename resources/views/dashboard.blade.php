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

<!-- Modal HTML -->


<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("emergencyButton");

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
        // Perform emergency stop action
        modal.style.display = "none"; // Close the modal after action
    });

    // Add event listener for No button
    document.getElementById('confirmNo').addEventListener('click', function() {
        modal.style.display = "none"; // Close the modal
    });
</script>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p>Are you sure you want to stop?</p>
        <div>
            <button id="confirmYes" class="px-4 py-2 mr-4 bg-green-500 text-white rounded">Yes</button>
            <button id="confirmNo" class="px-4 py-2 bg-red-500 text-white rounded">No</button>
        </div>
    </div>
</div>
@endsection

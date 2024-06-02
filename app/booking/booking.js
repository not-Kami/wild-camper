document.addEventListener('DOMContentLoaded', function() {
    if (document.getElementById('start-date') && document.getElementById('end-date')) {
        flatpickr("#start-date", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                instance.element.setAttribute('value', dateStr);
            }
        });

        flatpickr("#end-date", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr, instance) {
                instance.element.setAttribute('value', dateStr);
            }
        });
    }

    if (document.getElementById('vehicle')) {
        updateVehicleInfo(); // Update info for the initial selection
    }

    if (document.getElementById('confirm-button')) {
        document.getElementById('confirm-button').addEventListener('click', function() {
            fetch('confirmation.php', {
                method: 'POST'
            }).then(response => response.json())
              .then(data => {
                  if (data.status === 'success') {
                      document.getElementById('confirmation-message').style.display = 'block';
                      document.getElementById('confirm-button').style.display = 'none';
                      startCountdown(10, "../../index.php");
                  }
              });
        });
    }
});

function changeCount(id, delta) {
    const input = document.getElementById(id);
    const currentValue = parseInt(input.value);
    const newValue = currentValue + delta;
    const total = getTotalPeople();

    if (id === 'adults' && newValue < 1) return; // At least 1 adult
    if (id !== 'pets' && total + delta > 5) return; // Maximum 5 people excluding pets
    if (newValue < 0) return; // Prevent negative values

    input.value = newValue;
}

function getTotalPeople() {
    const adults = parseInt(document.getElementById('adults').value);
    const kids = parseInt(document.getElementById('kids').value);
    return adults + kids;
}

function validateForm() {
    const total = getTotalPeople();
    if (total < 1 || total > 5) {
        alert('Please ensure the total number of people excluding pets is between 1 and 5.');
        return false;
    }
    return true;
}

function updateVehicleInfo() {
    const select = document.getElementById('vehicle');
    const selectedOption = select.options[select.selectedIndex];
    const name = selectedOption.getAttribute('data-name');
    const price = selectedOption.getAttribute('data-price');
    const description = selectedOption.getAttribute('data-description');
    const image = selectedOption.getAttribute('data-image');

    const vehicleName = document.getElementById('vehicle-name');
    const vehicleDescription = document.getElementById('vehicle-description');
    const vehiclePrice = document.getElementById('vehicle-price');
    const vehicleImage = document.getElementById('vehicle-image');

    if (vehicleName && vehicleDescription && vehiclePrice && vehicleImage) {
        vehicleName.textContent = name;
        vehicleDescription.textContent = description;
        vehiclePrice.textContent = '$' + parseFloat(price).toFixed(2) + '/ week';
        const imagePath = "../../" + image;
        vehicleImage.src = imagePath;
        console.log("Image Path:", imagePath);
    }
}

function startCountdown(seconds, redirectUrl) {
    var countdownElement = document.getElementById('countdown');
    var interval = setInterval(function() {
        countdownElement.textContent = seconds;
        seconds--;
        if (seconds < 0) {
            clearInterval(interval);
            window.location.href = redirectUrl;
        }
    }, 1000);
}

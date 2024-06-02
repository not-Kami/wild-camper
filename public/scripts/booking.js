document.addEventListener('DOMContentLoaded', function () {
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    const nextToVehiclesButton = document.getElementById('next-to-vehicles');
    const vehicleCards = document.querySelectorAll('.vehicle-card');
    const confirmBookingButton = document.getElementById('confirm-booking');
    const datePicker = document.getElementById('datePicker');
    const adultsInput = document.getElementById('adults');
    const kidsInput = document.getElementById('kids');
    const selectedDatesElement = document.getElementById('selected-dates');
    const selectedVehicleElement = document.getElementById('selected-vehicle');
    const travellersSummaryElement = document.getElementById('travellers-summary');

    let selectedVehicleId = null;
    let selectedVehicleName = null;

    flatpickr(datePicker, {
        mode: "range",
        dateFormat: "Y-m-d",
        minDate: "today",
        onChange: function (selectedDates) {
            if (selectedDates.length === 2) {
                nextToVehiclesButton.classList.remove('hidden');
            }
        }
    });

    nextToVehiclesButton.addEventListener('click', function () {
        step1.classList.add('hidden');
        step2.classList.remove('hidden');
    });

    vehicleCards.forEach(card => {
        card.addEventListener('click', function () {
            selectedVehicleId = this.dataset.id;
            selectedVehicleName = this.querySelector('label').textContent;
            step2.classList.add('hidden');
            step3.classList.remove('hidden');
            selectedDatesElement.textContent = `Selected Dates: ${datePicker.value}`;
            selectedVehicleElement.textContent = `Selected Vehicle: ${selectedVehicleName}`;
            travellersSummaryElement.textContent = `Adults: ${adultsInput.value}, Kids: ${kidsInput.value}`;
        });
    });

    confirmBookingButton.addEventListener('click', function () {
        // Envoi des données à la base de données et redirection vers confirmation
        window.location.href = `confirmation.php?vehicle_id=${selectedVehicleId}&start_date=${datePicker.value.split(' to ')[0]}&end_date=${datePicker.value.split(' to ')[1]}&adults=${adultsInput.value}&kids=${kidsInput.value}`;
    });
});

function changeCount(id, delta) {
    const input = document.getElementById(id);
    const currentValue = parseInt(input.value);
    const newValue = currentValue + delta;
    if (newValue >= 0) {
        input.value = newValue;
    }
}

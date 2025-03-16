// Add event handling after DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const selectedSeats = new Set();
    const reserveButton = document.getElementById('reserveButton');
    const selectedSeatsInput = document.getElementById('selectedSeats');

    // Simplified seat toggle function
    window.toggleSeat = function (seat) {
        if (seat.classList.contains('taken')) return;

        const seatId = seat.dataset.seatId;

        // Toggle selection
        if (selectedSeats.has(seatId)) {
            selectedSeats.delete(seatId);
            seat.classList.remove('selected');
        } else {
            selectedSeats.add(seatId);
            seat.classList.add('selected');
        }

        // Update form and button
        selectedSeatsInput.value = Array.from(selectedSeats).join(',');
        reserveButton.disabled = selectedSeats.size === 0;
    };

    // Add click handlers to all available seats
    document.querySelectorAll('.seat.available').forEach(seat => {
        seat.addEventListener('click', () => toggleSeat(seat));
    });
});
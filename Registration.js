document.addEventListener('DOMContentLoaded', () => {
    const timeSlotSelect = document.getElementById('time_slot');
    const registrationForm = document.getElementById('registrationForm');

    if (!timeSlotSelect) {
        console.error("No element found with id 'time_slot'");
        return;
    }
    if (!registrationForm) {
        console.error("No element found with id 'registrationForm'");
        return;
    }

    // Fetch available time slots
    fetch('fetch_time_slots.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot.slot;
                option.text = `${slot.slot} (${slot.available_seats} seats available)`;
                timeSlotSelect.add(option);
            });
        })
        .catch(error => console.error('Error fetching time slots:', error));

    // Update available seats on selection change
    timeSlotSelect.addEventListener('change', () => {
        const selectedSlot = timeSlotSelect.value;
        fetch('fetch_time_slots.php')
            .then(response => response.json())
            .then(data => {
                const slot = data.find(s => s.slot === selectedSlot);
                if (slot && slot.available_seats === 0) {
                    alert('The selected time slot is fully booked.');
                    timeSlotSelect.value = '';
                }
            });
    });

    // Form validation on submission
    registrationForm.addEventListener('submit', function(event) {
        const email = document.getElementById('email').value;
        const phone = document.getElementById('phone').value;
        const firstName = document.getElementById('firstName').value;
        const lastName = document.getElementById('lastName').value;

        const namePattern = /^[A-Za-z]+$/;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const phonePattern = /^\d{10}$/;

        if (!namePattern.test(firstName) || !namePattern.test(lastName)) {
            alert('Names must contain only letters.');
            event.preventDefault();
        }

        if (!emailPattern.test(email)) {
            alert('Invalid email format.');
            event.preventDefault();
        }

        if (!phonePattern.test(phone)) {
            alert('Invalid phone number format.');
            event.preventDefault();
        }
    });
});

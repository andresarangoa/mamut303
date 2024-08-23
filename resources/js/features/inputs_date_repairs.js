window.addEventListener('DOMContentLoaded', () => {
    const availableHoursInput = document.getElementById('admited_hours');
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    availableHoursInput.addEventListener('input', function () {
        const availableHours = parseInt(this.value, 10);

        if (isNaN(availableHours)) {
            return;
        }

        // Calculate days based on available hours (1 day = 8 hours)
        const days = Math.ceil(availableHours / 8);

        // Get the selected start date
        const startDate = new Date(startDateInput.value);

        // Calculate the end date by adding the days to the start date
        const endDate = new Date(startDate);
        endDate.setDate(startDate.getDate() + days);

        // Format the end date as YYYY-MM-DD
        const year = endDate.getFullYear();
        const month = String(endDate.getMonth() + 1).padStart(2, '0');
        const day = String(endDate.getDate()).padStart(2, '0');
        const formattedEndDate = `${month}/${day}/${year}`;

        // Update the end date input field
        endDateInput.value = formattedEndDate;
    });
});
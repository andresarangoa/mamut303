
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';
import esLocale from '@fullcalendar/core/locales/es';


window.addEventListener('load', () => {
    const modalElement = document.getElementById('add-date-modal');

    // Initialize the modal instance
    const addDateModal = new Modal(modalElement);

    modalElement.setAttribute('data-modal-target', 'add-date-modal');
    let calendarEl = document.getElementById('calendar'); // Use plain DOM methods

    let calendar = new Calendar(calendarEl, {
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        events: bookings,
        locale: esLocale,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listWeek,timeGridWeek, prevYear,nextYear'
        },
        dateClick: function (info) {
            addDateModal.show();
            // Set the date in the start_date input field

            // Check if info.dateStr includes time
            let date = new Date(info.dateStr);
            let hasTime = !isNaN(date.getHours()) && (date.getHours() > 0 || date.getMinutes() > 0);

            if (hasTime) {
                // If there is time, set it in the start_time input field
                let hours = date.getHours().toString().padStart(2, '0');
                let minutes = date.getMinutes().toString().padStart(2, '0');
                $('#start_time').val(`${hours}:${minutes}`);
                // Remove the time part from start_date
                let startDate = info.dateStr.split('T')[0]; // Assuming ISO format, or adjust as necessary
                $('#start_date').val(startDate);
            } else {
                $('#start_date').val(info.dateStr);
                // If there is no time, clear the start_time input field
                $('#start_time').val('');
            }
        }
    });

    $(document).on('click', '#closeModal', function () {
        addDateModal.hide();
    });
    calendar.render();
});
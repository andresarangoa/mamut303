import './bootstrap';
import 'flowbite';
import jQuery from 'jquery';

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import interactionPlugin from '@fullcalendar/interaction';

window.$ = jQuery;

// FullCalendar initialization and configuration
window.addEventListener('load', () => {
    const addDateModal = new Modal(document.getElementById('add-date-modal'))
    let calendarEl = document.getElementById('calendar'); // Use plain DOM methods
    let calendar = new Calendar(calendarEl, {
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin, listPlugin],
        initialView: 'dayGridMonth',
        selectable: true,
        editable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,listWeek,timeGridWeek, prevYear,nextYear'
        },
        dateClick: function (info) {
            addDateModal.show();

            // Optionally, set the date in the input fields
            $('#start_date').val(info.dateStr);
            $('#end_date').val(info.dateStr);
        }
    });

    $(document).on('click', '#closeModal', function () {
        $('#tailwindModal').addClass('hidden'); // Hide Tailwind modal
    });
    calendar.render();
});
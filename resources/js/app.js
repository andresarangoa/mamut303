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
    let calendarEl = document.getElementById('calendar'); // Use plain DOM methods
    let calendar = new Calendar(calendarEl, {
        plugins: [interactionPlugin,dayGridPlugin, timeGridPlugin, listPlugin],
        initialView: 'dayGridMonth',
        selectable: true,
        editable:true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        dateClick: function(info) {
            // $('#tailwindModal').removeClass('hidden'); // Show Tailwind modal
            $('#exampleModalCenter').modal('show');
          }
    });

    $(document).on('click', '#closeModal', function() {
        $('#tailwindModal').addClass('hidden'); // Hide Tailwind modal
    });
    calendar.render();
});
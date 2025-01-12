import { showErrorMessage } from "../../common.js";

document.addEventListener('DOMContentLoaded', () => {
    function openShowModal(date) {
        fetch(`/timetable/${date}`)
            .then(response => response.text())
            .then(html => {
                document.querySelector('#show-timetable-cell-container').innerHTML = html;
            })
            .catch(error => {
                showErrorMessage('Unable to load modal window.')
            });
    }

    document.querySelectorAll('.calendar-cell').forEach(el => el.addEventListener('click', e => {
        if (parseInt(el.getAttribute('data-is-enabled'), 10)) {
            openShowModal(el.getAttribute('data-date'));
        }
    }));
});

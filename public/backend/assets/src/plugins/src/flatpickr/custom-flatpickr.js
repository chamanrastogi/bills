// Flatpickr

var f1 = flatpickr(document.getElementById('basicFlatpickr'), {
	 dateFormat: "d-m-Y",
    defaultDate: new Date()
});
var f2 = flatpickr(document.getElementById('basicFlatpickr2'), {
	 dateFormat: "d-m-Y",
    defaultDate: new Date()
});
var f3 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
    enableTime: true,
    dateFormat: "d-m-Y",
    defaultDate: new Date()
});
var f4 = flatpickr(document.getElementById('rangeCalendarFlatpickr'), {
    mode: "range",
});
var f5 = flatpickr(document.getElementById('timeFlatpickr'), {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",
    defaultDate: "13:45",
});
/* IM.JS 0.1 by Irene Njeri */
"use strict";
//TODO: proper JSDoc
document.addEventListener("DOMContentLoaded", function(event) {
	document.querySelectorAll('.im-time-now').forEach(e => displayTimeNow(e));
	document.querySelectorAll('.im-date-today').forEach(e => displayDateToday(e));
	let removeElemDelayed = delayDeco(removeElem, 9800);
	document.querySelectorAll('.im-msgs-container').forEach(e => removeElemDelayed(e));
});
document.addEventListener("click", function(event) {
	let target = event.target;
	if (target.closest('.im-closebtn')) {
		removeElem(target.closest('.im-closebtn').parentNode);
	}
});

/** Updates elem's innerHTML with current time every second */
function displayTimeNow(elem) {
	elem.innerHTML = timeNow();
	setInterval(() => {
		elem.innerHTML = timeNow();
	}, 1000);
}
/** Updates elem's innerHTML with current date */
function displayDateToday(elem) {
	elem.innerHTML = dateToday();
	setInterval(() => {
		let today = dateToday();
		if (elem.innerHTML !== today) elem.innerHTML = today;		
	}, 1000);
}
/** Returns current time as formatted by the Date object */
function timeNow() {
	return Date().slice(16, -28);
}
/** Returns current date as formatted by the Date object */
function dateToday() {
	return Date().slice(0, 16);
}
function disableElem(elem) {
  elem.classList.add("disabled");
  elem.setAttribute("disabled", true);
}
function enableElem(elem) {
  elem.classList.remove("disabled");
  elem.removeAttribute("disabled");
}
function hideElem(elem) {
  elem.classList.remove('show-inline');
  elem.classList.remove('show-inline-block');
  elem.classList.remove('show-block');

  elem.classList.add('hide');
}
function showElem(elem, display='inline-block') {
  elem.classList.remove('hide');

  elem.classList.add(`show-${display}`);
}
function removeElem(elem) {
	return elem.remove();
}
/** Returns a delayed version of function fn by ms milliseconds */
function delayDeco(fn, ms=1000) {
	return function(...args) {
		return setTimeout(fn, ms, ...args);
	}
}
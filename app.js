// JavaScript Reference, Febuary 2023

// Simple console log so you can just use log();
const log = console.log;

// Returns the first element that matches a CSS selector
function getElement(selector) {
    return document.querySelector(selector);
}
  
// Returns an array of all elements that match a CSS selector
function getElements(selector) {
    return document.querySelectorAll(selector);
}
  
// Adds a CSS class to an element
function addClass(element, className) {
    element.classList.add(className);
}

// Removes a CSS class from an element
function removeClass(element, className) {
    element.classList.remove(className);
}

// Toggles a CSS class on an element
function toggle(element, className) {
    element.classList.toggle(className);
}
  
// Checks whether an object is empty
function isEmpty(object) {
    return Object.keys(object).length === 0;
}
  
// Checks whether a value is a number
function isNumber(value) {
    return typeof value === 'number' && isFinite(value);
}
  
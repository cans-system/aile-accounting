import './bootstrap';
import * as bootstrap from "bootstrap";

const toastElList = document.querySelectorAll(".toast");
[...toastElList].map((toastEl) => {
  const toast = new bootstrap.Toast(toastEl);
  toast.show();
});

const hoverTriggerList = document.querySelectorAll('.hover');
[...hoverTriggerList].map(hoverTriggerEl => {
  hoverTriggerEl.addEventListener('mouseover', (event) => {
    let hoverEl = hoverTriggerEl.querySelector('.hover-list');
    hoverEl.style.display = 'block';
  });

  hoverTriggerEl.addEventListener('mouseleave', (event) => {
    let hoverEl = hoverTriggerEl.querySelector('.hover-list');
    hoverEl.style.display = 'none';
  });
});
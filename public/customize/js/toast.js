// Buat container khusus untuk toast
let toastContainer = document.getElementById("toastContainer");
if (!toastContainer) {
  toastContainer = document.createElement("div");
  toastContainer.id = "toastContainer";
  toastContainer.style.position = "fixed";
  toastContainer.style.zIndex = "9999"; // Biar nggak ketutup navbar
  toastContainer.style.pointerEvents = "none"; // Supaya nggak nge-blok interaksi
  toastContainer.style.display = "flex";
  toastContainer.style.flexDirection = "column";
  document.body.appendChild(toastContainer);
}

function showToast(titleOrMessage, message = "", type = "text-white", bg = "bg-primary", placement = "top-0 end-0") {
  let title, finalMessage;
  if (arguments.length === 1) {
    title = "INFO";
    finalMessage = titleOrMessage;
  } else {
    title = titleOrMessage;
    finalMessage = message;
  }

  let toastContainer = document.getElementById("toastContainer");
  if (!toastContainer) {
    toastContainer = document.createElement("div");
    toastContainer.id = "toastContainer";
    toastContainer.style.position = "fixed";
    toastContainer.style.zIndex = "1050";
    document.body.appendChild(toastContainer);
  }

  // Sesuaikan posisi container berdasarkan placement
  toastContainer.innerHTML = "";
  toastContainer.className = `toast-container position-fixed ${placement}`;

  // Buat elemen toast baru
  let toastEl = document.createElement("div");
  toastEl.className = `bs-toast toast m-2 ${bg} ${type}`;
  toastEl.setAttribute("role", "alert");
  toastEl.setAttribute("aria-live", "assertive");
  toastEl.setAttribute("aria-atomic", "true");
  toastEl.setAttribute("data-bs-delay", "3000");

  toastEl.innerHTML = `
    <div class="toast-header text-white">
      <i class="icon-base bx bx-bell me-2"></i>
      <div class="me-auto fw-bold">${title}</div>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">${finalMessage}</div>
  `;

  toastContainer.appendChild(toastEl);

  let toastInstance = new bootstrap.Toast(toastEl);
  toastInstance.show();

  setTimeout(() => {
    toastEl.remove();
  }, 3500);
}

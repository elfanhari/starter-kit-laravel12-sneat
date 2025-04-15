function showModal(id) {
  $('#' + id).modal("show");
}

function hideModal(id) {
  $('#' + id).modal("hide");
}

function initDataTable(id) {
  $(id).DataTable();
}

function removeValidationError(input) {
  input.classList.remove('is-invalid');
  let feedback = input.nextElementSibling;
  if (feedback && feedback.classList.contains('invalid-feedback')) {
    feedback.style.display = 'none';
  }
}

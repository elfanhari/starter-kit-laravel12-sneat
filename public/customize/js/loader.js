function showLoader(mode = "") {
  let loader = document.getElementById("loader");

  // Ubah transparansi jika mode "light"
  loader.style.background = mode === "light" ? "rgba(0, 0, 0, 0.2)" : "rgba(0, 0, 0, 0.5)";

  loader.style.display = "flex";

  // Jika mode "short", otomatis hilang dalam 3 detik
  if (mode === "short") {
    setTimeout(() => hideLoader(), 3000);
  }
}

function hideLoader() {
  document.getElementById("loader").style.display = "none";
}

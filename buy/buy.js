document.addEventListener("DOMContentLoaded", () => {
  const urlParams = new URLSearchParams(window.location.search);
  const houseId = urlParams.get("houseId");
  if (houseId) {
    document.getElementById("houseId").value = houseId;
  }
});

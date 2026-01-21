// Initialisation après chargement du DOM
document.addEventListener("DOMContentLoaded", function () {
  // Création de la carte
  var map = L.map("map").setView([48.0061, 0.1996], 13);

  L.tileLayer("https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png", {
    maxZoom: 19,
    attribution: "© OpenStreetMap contribs",
  }).addTo(map);

  // Récupération du HTML des cards comme popups
  function getCardHTML(id) {
    const card = document.querySelector(`.lieu-card[data-card="${id}"]`);
    return card ? card.innerHTML : "<p>Informations non disponibles</p>";
  }

  // Création des marqueurs avec popup HTML complet
  var markers = {
    campus: L.marker([48.0115, 0.1665])
      .addTo(map)
      .bindPopup(getCardHTML("campus"), { maxWidth: 300 }),
    rep: L.marker([48.0078, 0.1963])
      .addTo(map)
      .bindPopup(getCardHTML("rep"), { maxWidth: 300 }),
    saint: L.marker([48.0606, 0.1572])
      .addTo(map)
      .bindPopup(getCardHTML("saint"), { maxWidth: 300 }),
  };
});

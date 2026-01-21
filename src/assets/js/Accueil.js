document.addEventListener("DOMContentLoaded", function () {
  const data = window.accueilData || {};
  const target = data.nbObjetsRecycles || 0;
  const baseUrl = data.baseUrl || "/";

  // Animation du compteur
  function animateCounter() {
    const counter = document.querySelector(".counter-number");
    if (!counter) return;

    const duration = 2000;
    const steps = 60;
    const increment = target / steps;
    let current = 0;

    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        counter.textContent = target.toLocaleString("fr-FR");
        clearInterval(timer);
      } else {
        counter.textContent = Math.floor(current).toLocaleString("fr-FR");
      }
    }, duration / steps);
  }

  window.addEventListener("load", animateCounter);

  // Bouton formulaire de donation
  const donationBtn = document.querySelector(".donation-btn");
  if (donationBtn) {
    donationBtn.addEventListener("click", function () {
      window.location.href = baseUrl + "formulaire-donation";
    });
  }

  // Boutons "Voir notre Politique" / "Voir les Statistiques"
  document.querySelectorAll(".why-card-btn").forEach((btn, index) => {
    btn.addEventListener("click", function () {
      if (index === 0) {
        window.location.href = baseUrl + "notre-politique";
      } else {
        window.location.href = baseUrl + "statistiques";
      }
    });
  });

  // Bouton "Voir la Carte"
  const collectBtn = document.querySelector(".collect-btn");
  if (collectBtn) {
    collectBtn.addEventListener("click", function () {
      window.location.href = baseUrl + "carte";
    });
  }
});

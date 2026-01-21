// Navigation mois
const currentMois = window.dashboardData.mois;
const currentAnnee = window.dashboardData.annee;

function changerMois(direction) {
  let newMois = currentMois + direction;
  let newAnnee = currentAnnee;

  if (newMois > 12) {
    newMois = 1;
    newAnnee++;
  } else if (newMois < 1) {
    newMois = 12;
    newAnnee--;
  }

  window.location.href = `?section=accueil&mois=${newMois}&annee=${newAnnee}`;
}

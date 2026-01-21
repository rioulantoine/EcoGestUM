// Récupération des données injectées depuis PHP
const repartitionData = window.dashboardData.repartition;
const currentMois = window.dashboardData.mois;
const currentAnnee = window.dashboardData.annee;

// Graphique en donut
const ctx = document.getElementById("repartitionChart");

if (ctx && repartitionData && repartitionData.length > 0) {
  const labels = repartitionData.map((item) => item.nom_cat_obj);
  const data = repartitionData.map((item) => parseInt(item.nombre));
  const colors = [
    "#4dabf7",
    "#51cf66",
    "#ffd43b",
    "#ff6b6b",
    "#a78bfa",
    "#f472b6",
  ];

  new Chart(ctx, {
    type: "doughnut",
    data: {
      labels: labels,
      datasets: [
        {
          data: data,
          backgroundColor: colors.slice(0, data.length),
          borderWidth: 0,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
      plugins: {
        legend: {
          display: false,
        },
      },
    },
  });
}

// Navigation mois
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

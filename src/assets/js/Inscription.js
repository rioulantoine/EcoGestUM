document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".connexion-form");
  if (!form) return;

  form.addEventListener("submit", function (e) {
    const mdp1 = document.getElementById("motdepasse").value;
    const mdp2 = document.getElementById("confirmer_mdp").value;
    let erreurs = [];

    if (mdp1.length < 8) {
      erreurs.push("Le mot de passe doit contenir au moins 8 caractères");
    }
    if (!/[a-z]/.test(mdp1)) {
      erreurs.push("Le mot de passe doit contenir au moins une minuscule");
    }
    if (!/[0-9]/.test(mdp1)) {
      erreurs.push("Le mot de passe doit contenir au moins un chiffre");
    }
    if (!/[!@#$%^&*(),.?\":{}|<>]/.test(mdp1)) {
      erreurs.push(
        'Le mot de passe doit contenir au moins un caractère spécial (!@#$%^&*(),.?":{}|<>)'
      );
    }
    if (mdp1 !== mdp2) {
      erreurs.push("Les mots de passe sont différents");
    }

    let errDiv = document.getElementById("mdp-error");
    if (!errDiv) {
      errDiv = document.createElement("div");
      errDiv.id = "mdp-error";
      errDiv.className = "message-error";
      const submitBtn = document.querySelector(".connexion-btn");
      if (submitBtn && submitBtn.parentNode) {
        submitBtn.parentNode.insertBefore(errDiv, submitBtn);
      }
    }

    if (erreurs.length > 0) {
      errDiv.innerHTML =
        "<ul>" +
        erreurs.map((msg) => "<li>" + msg + "</li>").join("") +
        "</ul>";
      e.preventDefault();
    } else if (errDiv) {
      errDiv.innerHTML = "";
    }
  });
});

let specialiteFiltre = "Tous";
let anneeFiltre = "Tous";

function filtrerParSpecialite(specialite) {
  specialiteFiltre = specialite;
  const tableau = document.querySelectorAll("#tableau tbody tr");
  const boutonSpecialite = document.querySelectorAll(
    "#specialite-bouton .bouton-specialite"
  );

  boutonSpecialite.forEach((b) => {
    b.classList.remove("bg-[#00a5a5]", "text-white");
  });

  boutonSpecialite.forEach((bouton) => {
    if (bouton.textContent === specialite) {
      bouton.classList.add("bg-[#00a5a5]", "text-white");
    }
  });

  tableau.forEach(function (tableau) {
    const colonneSpecialite =
      tableau.querySelector("td:nth-child(5)").textContent;
    const colonneAnnee = tableau.querySelector("td:nth-child(4)").textContent;

    if (
      (specialiteFiltre === "Tous" || colonneSpecialite === specialiteFiltre) &&
      (anneeFiltre === "Tous" || colonneAnnee === anneeFiltre)
    ) {
      tableau.style.display = "table-row";
    } else {
      tableau.style.display = "none";
    }
  });
}

filtrerParSpecialite("Tous");

function filtrerParAnnee(annee) {
  anneeFiltre = annee;
  const tableau = document.querySelectorAll("#tableau tbody tr");
  const boutonAnnee = document.querySelectorAll("#annee-bouton .bouton-annee");

  boutonAnnee.forEach((b) => {
    b.classList.remove("bg-[#00a5a5]", "text-white");
  });

  boutonAnnee.forEach((bouton) => {
    if (bouton.textContent === annee) {
      bouton.classList.add("bg-[#00a5a5]", "text-white");
    }
  });

  tableau.forEach(function (tableau) {
    const colonneSpecialite =
      tableau.querySelector("td:nth-child(5)").textContent;
    const colonneAnnee = tableau.querySelector("td:nth-child(4)").textContent;

    if (
      (specialiteFiltre === "Tous" || colonneSpecialite === specialiteFiltre) &&
      (anneeFiltre === "Tous" || colonneAnnee === anneeFiltre)
    ) {
      tableau.style.display = "table-row";
    } else {
      tableau.style.display = "none";
    }
  });
}

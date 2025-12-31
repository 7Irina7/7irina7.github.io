// Nur zum Test
//alert("Willkommen");


  // Liste deiner drei Fotos
  const bilder = [
    "./images/balkon1.jpeg",
    "./images/balkon2.jpeg",
    "./images/balkon3.jpeg"
  ];

  let index = 0;
  const bildElement = document.getElementById("slideshow");

  // Funktion zum Wechseln der Bilder
  function wechselBild() {
    index = (index + 1) % bilder.length; // weiterzählen & von vorne beginnen
    bildElement.src = bilder[index];
  }

  // Bild alle 2 Sekunden wechseln
  setInterval(wechselBild, 2000);

  // Kommentar schreiben/ ausblenden Knopf
   document.querySelectorAll(".show-comment").forEach(link => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      const wrapper = this.nextElementSibling;     // textarea-wrapper
      const textarea = wrapper.querySelector("textarea");
      const counter = wrapper.querySelector(".char-count");

      if (wrapper.style.display === "none") {
    wrapper.style.display = "block";
    counter.style.display = "block";
    this.textContent = "Kommentar ausblenden";  
        } else {
    wrapper.style.display = "none";
    counter.style.display = "none";
    wrapper.value = "none";
    counter.textContent = "500";
    this.textContent = "💬 Kommentar schreiben";
        }
    });
  });



// Zeichen-Zähler für Textareas
document.querySelectorAll(".comment-textarea").forEach(textarea => {
  
  const counter = textarea.parentElement.querySelector(".char-count");

  textarea.addEventListener("input", function () {
      const max = 500;
      const remaining = max - this.value.length;
      counter.textContent = remaining + " Zeichen verbleibend";
  });
});

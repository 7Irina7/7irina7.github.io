// ================= SLIDESHOW =================
const bilder = [
  "./images/balkon1.jpeg",
  "./images/balkon2.jpeg",
  "./images/balkon3.jpeg"
];

let index = 0;
const bildElement = document.getElementById("slideshow");

if (bildElement) {
  setInterval(() => {
    index = (index + 1) % bilder.length;
    bildElement.src = bilder[index];
  }, 2000);
}

// ================= KOMMENTARE =================
document.querySelectorAll(".comment-block").forEach(block => {
  const btn = block.querySelector(".show-comment");
  const wrapper = block.querySelector(".textarea-wrapper");
  const textarea = block.querySelector(".comment-textarea");
  const counter = block.querySelector(".char-count");
  const max = textarea.maxLength;

  if (!btn || !wrapper || !textarea || !counter) return;

  // Startzustand erzwingen
  wrapper.style.display = "none";
  counter.textContent = max + " Zeichen verbleibend";

  btn.addEventListener("click", e => {
    e.preventDefault();
    e.stopPropagation();

    const isOpen = wrapper.style.display === "block";

    wrapper.style.display = isOpen ? "none" : "block";
    btn.textContent = isOpen
      ? "💬 Kommentar schreiben"
      : "Kommentar ausblenden";

    if (!isOpen) textarea.focus();
  });

  textarea.addEventListener("input", () => {
    counter.textContent =
      (max - textarea.value.length) + " Zeichen verbleibend";
  });
});

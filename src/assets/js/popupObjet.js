function lockBodyScroll(lock) {
  if (lock) {
    document.body.style.overflow = 'hidden';
    document.body.style.touchAction = 'none';
  } else {
    document.body.style.overflow = '';
    document.body.style.touchAction = '';
  }
}

document.addEventListener('DOMContentLoaded', function() {
  let objetSelectionne = null;

  document.querySelectorAll('.objet-card').forEach(card => {
    card.addEventListener('click', function() {
        objetSelectionne = this.dataset.id;
        let photo = this.dataset.photo;
        let src;
        if (photo.startsWith('http')) {
            src = photo;
        } else {
            src = 'src/assets/imgCache/' + photo;
        }
        document.getElementById('popup-img').src = src;

        document.getElementById('popup-title').textContent = this.dataset.nom;
        document.getElementById('popup-desc').textContent = this.dataset.desc;
        document.getElementById('popup-cat').textContent = this.dataset.cat;
        document.getElementById('popup-etat').textContent = this.dataset.etat;
        document.getElementById('popup-lieu').textContent = this.dataset.lieu;
        document.getElementById('overlay-popup').style.display = 'flex';
        lockBodyScroll(true);
    });
  });

  document.getElementById('close-popup').onclick = function() {
    document.getElementById('overlay-popup').style.display = 'none';
    lockBodyScroll(false);
  };

  document.getElementById('overlay-popup').onclick = null;

  document.getElementById('popup-reserver').onclick = function() {
    document.getElementById('popup-form-id').value = objetSelectionne;
    document.getElementById('form-reserver').submit();
  };
});

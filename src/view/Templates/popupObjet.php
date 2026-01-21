<div id="overlay-popup" style="display:none;">
  <div id="popup-objet">
    <button id="close-popup" aria-label="Fermer">&times;</button>
    <img id="popup-img" src="" alt="" />
    <h2 id="popup-title"></h2>
    <p><span id="popup-desc"></span></p>
    <div style="margin: 6px 0;">
      Catégorie : <span id="popup-cat"></span>
      <span style="margin-left:18px">État : <span id="popup-etat"></span></span>
    </div>
    <div id="popup-lieu" style="font-weight:bold; margin-bottom:10px;"></div>
    <!-- Le form caché pour la réservation (utile qu'il soit bien dans le popup) -->
    <form id="form-reserver" method="post" style="display:none;">
        <input type="hidden" name="action" value="reserver">
        <input type="hidden" name="id_obj_recycl" id="popup-form-id" value="">
    </form>

    <button id="popup-reserver" class="btn-reserver">Réserver</button>
  </div>
</div>

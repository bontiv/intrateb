{include "head.tpl"}

{include "$extendTpls/tripadm_menu.tpl"}

<div class="panel-group">

  <div class="panel panel-primary">
    <div class="panel-heading panel-title">
      Détails de la commande
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Element</th>
          <th style="min-width: 80px; width: 10%;">Prix</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Billet</td>
          <td>100 €</td>
        </tr>
        <tr>
          <td>Oh !</td>
          <td>30 €</td>
        </tr>
        <tr>
          <td>Truc</td>
          <td>20 €</td>
        </tr>
        <tr>
          <td>Le machin à 5€</td>
          <td>5 €</td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <th>TOTAL</th>
          <th>155 €</th>
        </tr>
      </tfoot>
    </table>
  </div>

  <div class="panel panel-info">
    <div class="panel-heading panel-title">
      Détails des dépôts
    </div>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Type</th>
          <th>Emétteur</th>
          <th>Banque</th>
          <th>Numéro</th>
          <th>Encaissement</th>
          <th style="min-width: 80px; width: 10%;">Prix</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>PAIEMENT</td>
          <td>Admin</td>
          <td>Espèces</td>
          <td></td>
          <td>N/A</td>
          <td>55 €</td>
        </tr>
        <tr>
          <td>PAIEMENT</td>
          <td>Père Noël</td>
          <td>LCL</td>
          <td>1234522</td>
          <td>N/A</td>
          <td>100 €</td>
        </tr>
        <tr>
          <td>CAUTION</td>
          <td>Papa</td>
          <td>LCL</td>
          <td>1234542</td>
          <td>N/A</td>
          <td>200 €</td>
        </tr>
      </tbody>
    </table>
  </div>


  {* Panel Footer *}
  <div class="panel panel-default">
    <div class="panel-footer">
      <a href="#" class="btn btn-primary">Paiement</a>
      <a href="#" class="btn btn-info">Caution</a>
      <a href="#" class="btn btn-default">Facture (PDF)</a>
    </div>
  </div>
  {* / Panel Footer *}

</div>

{include "foot.tpl"}
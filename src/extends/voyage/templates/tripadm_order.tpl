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
          <td>Billet : {$ufile->tu_type->tt_name}</td>
          <td>{$ufile->tu_type->tt_price} €</td>
        </tr>
        {if isset($opts)}
            {foreach $opts as $opt}
                <tr>
                  <td>{$opt->tou_option->too_option->topt_label} {$opt->tou_option->too_value}</td>
                  <td>{$opt->tou_option->too_price} €</td>
                </tr>
            {/foreach}
        {else}
            <tr>
              <td class="text-muted" colspan="2">Aucune option</td>
            </tr>
        {/if}
        <tr>
          <th>TOTAL</th>
          <th>{$total} €</th>
        </tr>
      </tbody>
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
          <th>Methode</th>
          <th>Emétteur</th>
          <th>Banque</th>
          <th>Numéro</th>
          <th>Encaissement</th>
          <th style="min-width: 80px; width: 10%;">Paiement</th>
          <th style="min-width: 80px; width: 10%;">Caution</th>
        </tr>
      </thead>
      <tbody>
        {if isset($chqs)}
            {foreach $chqs as $chq}
                <tr>
                  <td>{$chq->tq_type}</td>
                  <td>{$chq->tq_method}</td>
                  <td>{$chq->tq_from}</td>
                  <td>{$chq->tq_bank}</td>
                  <td>{$chq->tq_number}</td>
                  <td>N/A</td>
                  <td>
                    {if $chq->raw_tq_type=='PAYMENT'}
                        {$chq->tq_amount} €
                    {/if}
                  </td>
                  <td>
                    {if $chq->raw_tq_type<>'PAYMENT'}
                        {$chq->tq_amount} €
                    {/if}
                  </td>
                </tr>
            {/foreach}
        {else}
            <tr>
              <td colspan="7" class="warning">
                Aucun dépôt effectué.
              </td>
            </tr>
        {/if}
        <tr class="info">
          <th colspan="6">TOTAL</th>
          <th>{$paiement} €</th>
          <th>{$caution} €</th>
        </tr>
      </tbody>
    </table>
  </div>


  {* Panel Footer *}
  <div class="panel panel-default">
    <div class="panel-footer">
      <a href="{mkurl action="tripadm" page="add_pay" file=$ufile->tu_id}" class="btn btn-primary">Paiement</a>
      <a href="{mkurl action="tripadm" page="add_caution" file=$ufile->tu_id}" class="btn btn-info">Caution</a>
      <a href="#" class="btn btn-default">Facture (PDF)</a>
    </div>
  </div>
  {* / Panel Footer *}

</div>

{include "foot.tpl"}
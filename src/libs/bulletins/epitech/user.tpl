{include "head.tpl"}

<ol class="breadcrumb">
  <li><a href="{mkurl action="bulletin"}">Mes bulletins</a></li>
  <li class="active">{$bulletin.bu->bu_period->period_label}</li>
</ol>

<H2>{$bulletin.bu->bu_period->period_label}</H2>

<div class="container">
  <div class="row-fluid">
    <div class="col-lg-4">Ecole</div>
    <div class="col-lg-8">{$bulletin.bu->bu_period->period_type->ut_name}</div>
  </div>

  <div class="row-fluid">
    <div class="col-lg-4">Début</div>
    <div class="col-lg-8">{$bulletin.bu->bu_period->period_start}</div>
  </div>

  <div class="row-fluid">
    <div class="col-lg-4">Fin</div>
    <div class="col-lg-8">{$bulletin.bu->bu_period->period_end}</div>
  </div>
</div>

<h3>Détails</h3>
<table class="table">
  <tr>
    <th>Activité</th>
    <th>Epices</th>
  </tr>
  {foreach $bulletin.data as $mark}
      <tr>
        <td>{$mark.label}</td>
        <td>{$mark.duration}</TD>
      </tr>
  {/foreach}
  <tr>
    <td><STRONG>TOTAL</STRONG></td>
    <td><STRONG>{$bulletin.spice}</strong></td>
  </tr>
</table>
{include "foot.tpl"}

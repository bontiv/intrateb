{include "head.tpl"}

<ol class="breadcrumb">
  <li role="presentation"><a href="{mkurl action="trip"}">Voyages</a></li>
  <li role="presentation" class="active">{$trip->tr_name|escape}</li>
</ol>

<h1>Voyage <small>{$trip->tr_name|escape}</small></h1>
<h2>Dossier d'inscription <small>étape 3</small></h2>

<div class="progress">
  <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%">
    <span class="sr-only">30% Complete</span>
  </div>
</div>


<form method="POST" action="{mkurl action="tripusr" page="step3" file=$ufile->tu_id}" class="form-horizontal">
  <div class="panel-group">

    {foreach $groups as $gname => $qlist}

        {* Panel santé *}
        <div class="panel panel-default">
          <div class="panel-heading panel-title">
            {$gname}
          </div>
          <div class="panel-body">
            <fieldset>
              {foreach $qlist as $qinfo}
                  <!-- Select Basic -->
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="q{$qinfo.question->topt_id}">{$qinfo.question->topt_question}</label>
                    <div class="col-md-4">
                      <select id="q{$qinfo.question->topt_id}" name="opt[{$qinfo.question->topt_id}]" class="form-control">
                        {foreach $qinfo.options as $opt}
                            <option value="{$opt->too_id}">{$opt->too_value} ({$opt->too_price} €)</option>
                        {/foreach}
                      </select>
                    </div>
                  </div>
              {/foreach}
            </fieldset>

          </div>
        </div>
        {* / Panel traveller *}

    {/foreach}


    {* Panel Footer *}
    <div class="panel panel-default">
      <div class="panel-footer">
        <input type="submit" class="btn btn-primary" value="Suivant" />
      </div>
    </div>
    {* / Panel Footer *}

  </div>
</form>

{include "foot.tpl"}

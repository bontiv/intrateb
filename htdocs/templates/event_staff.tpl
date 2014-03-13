{include "head.tpl"}

<h1>Staffs section {$section.section_name} sur {$event.event_name}</h1>
<h2>Section {$section.section_name}</h2>
<p>Section crée par {$section.user_name}. C'est une {if $section.section_type="primary"}section principale{else}sous section{/if}.</p>

<div>
{if not $section.inType}
    <a href="{mkurl action="event" page="goout" section=$section.section_id}" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Quitter</a>
    {else}
    <a href="{mkurl action="event" page="goin" section=$section.section_id}" class="btn btn-info"><i class="glyphicon glyphicon-heart"></i> Rejoindre</a>
    {/if}
</div>
<h3>Membres</h3>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Type</th>
            <th>Login</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        {foreach from=$users item="line"}
            <tr>
                <td>{$line.user_name}</td>
                <td><span class="label label-success">Staff</span></td>
                <td>{$line.user_login}</td>
                <td>{$line.user_email}</td>
                <td>{$line.user_phone}</td>
                <td>
                    <div class="btn-group">
                        <a href="{mkurl action="section" page="reject" user=$line.user_id section=$section.section_id}" class="btn btn-danger"><span class="glyphicon-remove glyphicon"></span></a>
                        <a href="{mkurl action="section" page="manager" user=$line.user_id section=$section.section_id}" class="btn btn-warning"><span class="glyphicon-thumbs-up glyphicon"></span></a>
                    </div>
                </td>
            </tr>
        {/foreach}
    </tbody>
</table>
{include "foot.tpl"}
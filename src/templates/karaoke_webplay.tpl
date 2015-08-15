{include "head.tpl"}

<script type="text/javascript" src="js/player.min.js"></script>
<style type="text/css">
  .ToyundaPlayer .subtitles,  .ToyundaPlayer .subtitles div {
      position: absolute;
      font-family: "courier new",monospace;
      font-weight: bolder;
      color: white;
      text-shadow:
          -1px -1px 0 #000,
          1px -1px 0 #000,
          -1px 1px 0 #000,
          1px 1px 0 #000;
  }
  .ToyundaPlayer .subtitles div {
      width: 100%;
      text-align: center;
  }
  .ToyundaPlayer .controls {
      position: absolute;
      bottom: 0;
      left:auto;
      background: rgba(0, 0, 100, 0.3);
      padding: 10px 15px;
      width: 100%;
      margin-right: -30px;
      display: none;
  }
  .ToyundaPlayer .controls:hover {
      display: block !important;
  }
</style>

<div class="alert alert-info">
  Ce player Toyunda HTML5 est expérimental.
</div>

<div class="col-md-6 col-md-offset-3">
  <Toyunda-Player style="width: 100%" src="http://webplayer.bonnetlive.net/times/Aa megamisama - AMV - Shining Collection" id="proc"/>
</div>

{include "foot.tpl"}

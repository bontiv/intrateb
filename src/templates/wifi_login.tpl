<!DOCTYPE html>
<html>
  <head>
    <!-- Css -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/jquery-ui-1.10.4.custom.min.css" rel="stylesheet">
    <!-- /Css -->
    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/jquery-ui-1.10.4.custom.min.js"></script>
    <script src="js/datetime-picker.min.js"></script>
    <!-- /Scripts -->

    <title>WiFi Auth</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>

    <script type="text/javascript" >
        function crytogun(form)
        {
            var login = form.elements;
            var chain = My_Crypt(login.login.value + ":" + login.password.value);
            login.password.value = My_Crypt(chain + "9c2f79bac069cb2cb08ef5e58d427adf");
        }
    </script>
    <script type="text/javascript" src="crypt.js" >alert("Impossible de lancer l'algo de cryptage")</script>


    {if isset($hsuccess)}
        {if $hsuccess}
            <div class="alert alert-success"><p>Opération effectué avec succès.</p></div>
        {else}
            <div class="alert alert-danger"><p>Une erreur a empêché l'opération.</p></div>
        {/if}
    {/if}

    <div class="hidden-sm hidden-xs" class="container" style="position:absolute; left:35%; top:30%; max-width: 330px;
         padding: 19px 29px 29px;
         margin: 0 auto 20px;
         background-color: #fff;
         border: 1px solid #e5e5e5;
         -webkit-border-radius: 5px;
         -moz-border-radius: 5px;
         border-radius: 5px;
         -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
         -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
         box-shadow: 0 1px 2px rgba(0,0,0,.05);">
      <form id="login" name="login" class="form-signin" onsubmit="return crytogun(this)" method="POST">
        <center><h2 class="form-signin-heading">Identifiez-vous</h2></center>
        <table border="0" style="">
          <tbody><tr>
              <td>Utilisateur</td>
              <td><input class="form-control" class="input-block-level" type="text" name="login" /></td>
            </tr>
            <tr>
              <td>Mot de passe</td>
              <td><input class="form-control" class="input-block-level" type="password" name="password" /></td>
            </tr>
          </tbody></table>
        <button style="float:right" class="btn btn-large btn-primary" type="submit" value="OK">Connexion</button>
      </form>
    </div>


    <div class="hidden-md hidden-lg container-fluid container">
      <form id="login-xs" name="login" class="form-signin form-horizontal" onsubmit="return crytogun(this)" method="POST">
        <legend>Identifiez-vous</legend>

        <fieldset>
          <div class="form-group">
            <label class="col-md-4 control-label" for="login">Utilisateur</label>
            <div class="col-md-8">
              <input class="form-control input-md" type="text" id="login" name="login" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="password">Mot de passe</label>
            <div class="col-md-8">
              <input class="form-control input-md" type="password" id="password" name="password" />
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-offset-4 col-md-8">
              <button style="float:right" class="btn btn-large btn-primary" type="submit" value="OK">Connexion</button>
            </div>
          </div>

        </fieldset>
      </form>
    </div>



  </div>


  <script type="text/javascript">
      (function () {
          var s = document.createElement("script");
          s.type = "text/javascript";
          s.async = true;
          s.src = '//api.usersnap.com/load/' +
                  '6bd81cc0-fb0a-435a-91d7-113d5ccb2f15.js';
          var x = document.getElementsByTagName('script')[0];
          x.parentNode.insertBefore(s, x);
      })();
  </script>

</body>

</html>


<footer>
  <div class="container">
    <div class="half">
      <a href="tel:+49305589079">+49&nbsp;30&nbsp;558&nbsp;90&nbsp;79</a><br><br>
      <a href="mailto: mail@homeofpirates.de">mail@homeofpirates.de</a>
    </div>
    <div class="half" id="footerRight">
      <a href="impressum.php">Impressum</a><br><br>
      <a href="datenschutz.php">Datenschutz</a>
    </div>
    <div class="row">
      <small>
        © <?php echo date("Y");?>, Home of pirates GmbH.   Alle Rechte vorbehalten.
      </small>
    </div>
  </div>
</footer>



<script>
    function submitMainForm(controller, action = 'render',targetblank = false){
        if(targetblank != false) {
            $("#mainForm").attr("target", "_blank");
        }

        $('#controller').val(controller);
        $('#action').val(action);
        $("#mainForm").submit();
    }
    $(":target").show();
</script>
</body>
</html>

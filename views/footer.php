<footer>
  <div class="container">
    <div class="half">
      <a class="footer" href="tel:+49305589079">+49&nbsp;30&nbsp;558&nbsp;90&nbsp;79</a><br><br>
      <a class="footer" href="mailto: mail@homeofpirates.de">mail@homeofpirates.de</a>
    </div>
    <div class="half" id="footerRight">
      <a class="footer" href="impressum" onclick="submitMainForm('Impressum', 'render')">Impressum</a><br><br>
      <a class="footer" href="datenschutz" onclick="submitMainForm('Datenschutz', 'render')">Datenschutz</a>
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

<footer>
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
</script>
</body>
</html>

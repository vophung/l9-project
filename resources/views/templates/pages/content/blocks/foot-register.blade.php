<script>
    $(function(){
      $('#password,#password_confirm').on('keypress', function(e){
        if(e.which === 32){
          return false;
        }
      });
    });
</script>
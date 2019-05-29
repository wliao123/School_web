
<link rel="stylesheet" type="text/css" href="http://weblab.salemstate.edu/~S0297324/capstone/admin/time_bootstrap/dist/bootstrap-clockpicker.min.css">

<div class="container">
    <input id="input-a" value="" data-default="20:48">
    
    <button type="button" id="button-b">Set</button>
</div>
                
               <script type="text/javascript" src="http://weblab.salemstate.edu/~S0297324/capstone/admin/time_bootstrap/dist/bootstrap-clockpicker.min.js"></script>
<script var input = $(#input-a);
input.clockpicker({
    autoclose: true
});

$(#button-b).click(function(e){
    // Have to stop propagation here
    e.stopPropagation();
    input.clockpicker(show)
            .clockpicker(toggleView, hours);
});>
</script>
              
             
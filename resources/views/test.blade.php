<form method="POST" action="" enctype="mutipart/form-data">
    <input type="file" name="f" id="file">
    {{csrf_field()}}
    <input type="submit" value="submit">
</form>

<script type="text/javascript" src="{{asset('js/jquery-3.1.1.js')}}"></script>
<script type="text/javascript">
function getBase64(file) {
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
     // console.log(reader.result);
     return reader.result;
   };
   reader.onerror = function (error) {
     console.log('Error: ', error);
     return false;
   };
}

$(document).on('change', '#file', function() {
    // console.log($(this).files);
    var file = document.querySelector('input[type="file"]').files[0];
    // console.log(getBase64(file)); // prints the base64 string 
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
     // console.log(reader.result);
     $.ajax({
            url: '{{url('test')}}',
            type: 'POST',
            data: 'f=' + reader.result + '&_token={{csrf_token()}}',
            success: function(r) {
                console.log(r);
            },
            error: function(r) {
                console.log(r);
            }
        });
   };
    
});


   
</script>
@extends(getTemplate().'.view.layout.layout')

@section('content')
<form enctype="multipart/form-data" action="http://tzenik.com/api/v1/user/uploadHomeworks" method="post">
    <input type="text" name="token" value="ucz6wKPBZpBiU3bR">
    <input type="text" name="course" value="1">
    <input type="text" name="part" value="1">
    <input name="file" type="file" multiple>
    <input type="submit" value="Send File" />
</form>
<br>
<button id="upload" onClick="upload();">Subir</button>
<script>
    function upload(){
        var formData = new FormData();
        formData.append('token', 'ucz6wKPBZpBiU3bR');
        formData.append('product', '1');
        formData.append('part', '1');
        // Attach file
        formData.append('file', $('input[type=file]')[0].files[0]); 

        $.ajax({
            url: '/api/v1/user/uploadHomeworks',
            data: formData,
            type: 'POST',
            contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
            processData: false, // NEEDED, DON'T OMIT THIS
            success: function(data){
                console.log(data);
            }
            // ... Other options like success and etc
        });
    }
</script>
@endsection
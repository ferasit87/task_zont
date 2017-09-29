<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:06 AM
 */


?>
<script type="text/javascript">
   function  addnewpost() {
       var user = $('#user').val();
       var content = $('#content').val();
       var title = $('#title').val();
       var post = {
           user: user,
           content:content,
           title:title,
       }
       $.ajax({
           url: '/post/add/',
           type: 'post',
           dataType: 'json',
           success: function (data) {
               var output = '' ;
               for (var property in data) {
                   output += property + ': ' + data[property]+'; ';
               }
               console.log(data);
               $('#result').css("color","green");
                $('#result').html(output);
           },
           error :  function (data) {

               console.log(data.responseText);
               $('#result').css("color","red");
               $('#result').html(data.responseText);
           },
           data: post
       });
   }

</script>
<div class="container">
    <div class="bs-docs-section">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <h2>Add new Post</h2>
                <div class="form-group">
                    <label for="formGroupExampleInput">User</label>
                    <input type="text" class="form-control" id="user" placeholder="логин">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput">Tilte</label>
                    <input type="text" class="form-control" id="title" placeholder="заголовок">
                </div>
                <div class="form-group">
                    <label for="exampleTextarea">Content</label>
                    <textarea class="form-control" id="content" rows="3"></textarea>
                </div>
                <button type="button" class="btn btn-primary" onclick="addnewpost();">Add new post </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="result" class="with-margin-top col-sm-6 col-md-6">
        </div>
    </div>
</div>
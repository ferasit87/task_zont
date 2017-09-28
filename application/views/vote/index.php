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
       var id_post = $('#id_post').val();
       var value = $('#value').val();
       var vote = {
           id_post: id_post,
           value:value
       }
       $.ajax({
           url: '/vote/add/',
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
               var output = '' ;
               for (var property in data) {
                   output += property + ': ' + data[property]+'; ';
               }
               console.log(data.responseText);
               $('#result').css("color","red");
               $('#result').html(data.responseText);
           },
           data: vote
       });
   }

</script>
<div class="container">
    <div class="bs-docs-section">
        <div class="row">
            <div class="col-sm-6 col-md-6">
                <h2>Add vote to post</h2>
                <div class="form-group">
                    <label for="formGroupExampleInput">Post ID</label>
                    <input type="text" class="form-control" id="id_post" placeholder="логин">
                </div>
                <div class="form-group">
                    <label for="exampleSelect1">Select vote </label>
                    <select class="form-control" id="value">
                        <option value="0">--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <button type="button" class="btn btn-primary" onclick="addnewpost();">Add new vote</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div id="result" class="with-margin-top col-sm-6 col-md-6">
        </div>
    </div>
</div>
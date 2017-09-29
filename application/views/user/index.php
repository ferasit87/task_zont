<?php
/**
 * Created by PhpStorm.
 * User: feras
 * Date: 9/27/17
 * Time: 9:06 AM
 */


?>
<script type="text/javascript">

       $.ajax({
           url: '/user/get_difference_ips/',
           type: 'get',
           dataType: 'json',
           success: function (data) {
               console.log(data);
               Object.keys(data);
               var output = '';
               if (Object.keys(data).length > 0 ){

                   for (var i = 0; i < Object.keys(data).length; i++) {
                       output +='<h5>IP : '+Object.keys(data)[i]+'<h5>';
                       output += '<table class="table">\n' +
                           '                <thead class="thead-inverse">\n' +
                           '                <tr>\n' +
                           '                    <th>user id</th>\n' +
                           '                    <th>user name</th>\n' +
                           '                </tr>\n' +
                           '                </thead>\n' +
                           '                <tbody>';
                       for (var y = 0; y < data[Object.keys(data)[i]].length; y++) {
                           output += '<tr>\n' +
                               '                    <th scope="row">' + data[Object.keys(data)[i]][y].id + '</th>\n' +
                               '                    <td>' + data[Object.keys(data)[i]][y].name + '</td>\n' +
                               '                </tr>';
                       }
                       output += '</tbody>\n' +
                           '            </table>';
                   }

               }
               $('#result').css("color","green");
               $('#result').html(output);
           },
           error :  function (data) {
               console.log(data.responseText);
               $('#result').css("color","red");
               $('#result').html(data.responseText);
           },
           data: null
       });


</script>
<div class="container">
    <div class="row">
        <div id="result" class="with-margin-top col-sm-6 col-md-6">
        </div>
    </div>
</div>

<!doctype html>
<html>
<body>
<input type='text' id='search' name='search' placeholder='Enter userid 1-27'><input type='button' value='Search' id='but_search'>
<br/>
<input type='button' value='Fetch all records' id='but_fetchall'>

<table border='1' id='userTable' style='border-collapse: collapse;'>
  <thead>
  <tr>
    <th>S.no</th>
    <th>Username</th>
    <th>Name</th>
    <th>Email</th>
    <th>Telephone</th>
  </tr>
  </thead>
  <tbody></tbody>
</table>

<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>  <!-- jQuery CDN -->
<!--<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script-->

<script type='text/javascript'>
  $(document).ready(function(){

    // Fetch all records
    $('#but_fetchall').click(function(){
      fetchRecords();
    });

    // Search by userid
    $('#but_search').click(function(){
      var userid = Number($('#search').val().trim());

      if(userid > 0){
        fetchRecords(userid);
      }

    });

  });

  function fetchRecords(){
    $.ajax({
      url: 'getUsers/',
      type: 'get',
      dataType: 'json',
      success: function(response){

        var len = 0;
        $('#userTable tbody').empty(); // Empty <tbody>
        if(response['data'] != null){
          len = response['data'].length;
        }

        //[{"user_id":1,"first_name":"Zome","last_name":"Serges","email":"zomeserges@gmail.com","telephone":"07558605554","password":"40bd001563085fc35165329ea1ff5c5ecbdbbeef","ver_token":null,"created_at":"2021-01-16T21:11:41.000000Z","updated_at":"2021-01-16T21:11:41.000000Z","type":"Super Admin"}]}

        if(len > 0){
          for(var i=0; i<len; i++){
            var id = response['data'][i].user_id;
            let username = response['data'][i].first_name;
            let name = response['data'][i].last_name;
            let email = response['data'][i].email;
            let tel = response['data'][i].telephone;

            var tr_str = "<tr>" +
              "<td align='center'>" + (i+1) + "</td>" +
              "<td align='center'>" + username + "</td>" +
              "<td align='center'>" + name + "</td>" +
              "<td align='center'>" + email + "</td>" +
              "<td align='center'>" + tel + "</td>" +
              "</tr>";

            $("#userTable tbody").append(tr_str);
          }
        }else{
          var tr_str = "<tr>" +
            "<td align='center' colspan='4'>No record found.</td>" +
            "</tr>";

          $("#userTable tbody").append(tr_str);
        }

      }
    });
  }
</script>
</body>
</html>

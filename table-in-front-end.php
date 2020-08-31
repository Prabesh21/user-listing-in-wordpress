<!DOCTYPE html>
<html>
<head>
<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> 
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://pagination.js.org/dist/2.1.4/pagination.min.js"></script>
</head>
<body>
<form class="woocommerce-ordering" method="get">
<div class="header1"> 
<label class="label">Role
<select name="my_role" id="my_role" >
  <option value="administrator">Administrator</option>
  <option value="editor">Editor</option>
  <option value="author">Author</option>
  <option value="contributor">Contributor</option>
  <option value="subscriber" selected>Subscirber</option>
</select>
</label>
</div>
<div class="header2">
<label class="label">Order
<select name="my_order" id="my_order" class="arrows">
  <option value="ASC">Ascending</option>
  <option value="DESC">Descending</option>
</select></label>
</div>
<div class="header3">
<label class="label">Order By
<select name="order_by" id="order_by">
  <option value="user_login">Username</option>
  <option value="display_name">Display Name</option>
</select>
</label>
</div>
<input type="hidden" name="paged" value="1">


<p id="showData"></p>
</body> 
<div class="container">
<table id = "tbody" class="paginated">
<caption class="caption">User's list</caption>
    <thead>
      <tr>
        <th>Username</th>
        <th>Display Name</th>
        <th>Roles</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
  </form>
</div>
<div id="pagination"></div>

</body>
</html>

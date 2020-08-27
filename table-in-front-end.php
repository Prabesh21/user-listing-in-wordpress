<!DOCTYPE html>
<html>
<head>
<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
</style>
<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> 
	</script>
</head>
<select name="my_role" id="my_role">
  <option value="administrator">Administrator</option>
  <option value="editor">Editor</option>
  <option value="author">Author</option>
  <option value="contributor">Contributor</option>
  <option value="subscriber" selected>Subscirber</option>
</select>
<select name="my_order" id="my_order">
  <option value="ASC">Ascending</option>
  <option value="DESC">Descending</option>
</select>
<select name="order_by" id="order_by">
  <option value="user_login">Username</option>
  <option value="display_name">Display Name</option>
</select>
<body>
<p id="showData"></p>
</body> 
<div class="container">
<table id = "tbody" class="paginated">
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
</div>

</body>
</html>

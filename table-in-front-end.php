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
<label class="label"><?php esc_html_e('Role', 'user-listing'); ?>
<select name="my_role" id="my_role" >
  <option value="administrator"><?php esc_html_e('Administrator', 'user-listing'); ?> </option>
  <option value="editor"><?php esc_html_e('Editor', 'user-listing'); ?></option>
  <option value="author"><?php esc_html_e('Author', 'user-listing'); ?></option>
  <option value="contributor"><?php esc_html_e('Contributor', 'user-listing'); ?></option>
  <option value="subscriber" selected><?php esc_html_e('Subscirber', 'user-listing'); ?></option>
</select>
</label>
</div>
<div class="header2">
<label class="label"><?php esc_html_e('Order', 'user-listing'); ?>
<select name="my_order" id="my_order" class="arrows">
  <option value="ASC"><?php esc_html_e('Ascending', 'user-listing'); ?></option>
  <option value="DESC"><?php esc_html_e('Descending', 'user-listing'); ?></option>
</select></label>
</div>
<div class="header3">
<label class="label"><?php esc_html_e('Order By', 'user-listing');?>
<select name="order_by" id="order_by">
  <option value="user_login"><?php esc_html_e('Username', 'user-listing');?></option>
  <option value="display_name"><?php esc_html_e('Display Name', 'user-listing');?></option>
</select>
</label>
</div>
<input type="hidden" name="paged" value="1">


<p id="showData"></p>
</body> 
<div class="container">
<table id = "tbody" class="paginated">
<caption class="caption"><?php esc_html_e('User list', 'user-listing');?></caption>
    <thead>
      <tr>
        <th><?php esc_html_e('Username', 'user-listing');?></th>
        <th><?php esc_html_e('Display Name', 'user-listing');?></th>
        <th><?php esc_html_e('Roles', 'user-listing');?></th>
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

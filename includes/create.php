<h1>Add Item</h1>
	<form action="create.php" method="post" >
	  <!-- input box for item name  -->
	  <label for="name">Item Name:</label>
	  <input type="text" 
	  id="item_name" 
	  class="form-control" 
	  name="item_name" 
	  required 
	  value="<?php if (isset($_POST['item_name'])) echo $_POST['item_name']; ?> ">
	  
	  <!-- input box for item description -->  
	  <label for="description">Description:</label>
	  <textarea id="item_desc" 
	  class="form-control" 
	  name="item_desc" 
	  required 
	  value="<?php if (isset($_POST['item_desc'])) echo $_POST['item_desc']; ?>">
	  </textarea>
	  
	 <!-- input box for image path -->
	 <label for="image">Image:</label>
	 <input type="text" 
	 id="item_img" 
	 class="form-control" 
	 name="item_img" 
	 required 
	 value="<?php if (isset($_POST['item_img'])) echo $_POST['item_img']; ?>">
	 
	 <!-- input box for item price -->
	 <label for="price">Price:</label>
	 <input 
	 type="number" 
	 id="item_price" 
	 class="form-control" 
	 name="item_price" 
	 min="0" step="0.01" 
	 required 
	 value="<?php if (isset($_POST['item_price'])) echo $_POST['item_price']; ?>"><br>
	  <!-- submit button -->
     <input type="submit" class="btn btn-dark" value="Submit">
	</form>
</div>



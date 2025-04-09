document.getElementById('productForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
  
    // Get form data
    var productName = document.getElementById('productName').value;
    var productDescription = document.getElementById('productDescription').value;
    var productCategory = document.getElementById('productCategory').value;
    var productPrice = document.getElementById('productPrice').value;
    var productQuantity = document.getElementById('productQuantity').value;
    var productImage = document.getElementById('productImage').files[0];
  
    // Create FormData object to send data as multipart/form-data
    var formData = new FormData();
    formData.append('productName', productName);
    formData.append('productDescription', productDescription);
    formData.append('productCategory', productCategory);
    formData.append('productPrice', productPrice);
    formData.append('productQuantity', productQuantity);
    formData.append('productImage', productImage);
  
    // Here you can send the formData to the server using AJAX or any other method
    // For demonstration purpose, let's log the form data
    for (var pair of formData.entries()) {
      console.log(pair[0] + ': ' + pair[1]);
    }
  });
  
function Order() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      if (response.status === 'success') {
        alert(response.message);
      } else {
        alert(response.message);
      }
    }
  };
  xhr.open("GET", "place_order.php", true);
  xhr.send();
}

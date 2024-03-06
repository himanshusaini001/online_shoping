<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <title>Bootstrap Data Table with Search and Pagination</title>
</head>
<body>

<div class="container mt-5">
  <h2>Bootstrap Data Table</h2>

  <!-- Search field and entries per page dropdown -->
  <div class="row mb-3">
    <div class="col-md-6">
      <input type="text" class="form-control" id="search" placeholder="Search" onkeyup="searchTable()">
    </div>
    <div class="col-md-6">
      <label for="entriesPerPage">Entries per page:</label>
      <select class="form-control" id="entriesPerPage" onchange="changeEntriesPerPage()">
        <option>5</option>
        <option>10</option>
        <option>20</option>
      </select>
    </div>
  </div>

  <!-- Data Table -->
  <table class="table" id="dataTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
         <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>
	     <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>
	     <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>
	     <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>   <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>   <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>
	     <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>   <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>   <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>valuev
	     <tr>
        <td>2</td>
        <td>sahil Doe</td>
        <td>jane@example.com</td>
      </tr>
	     <tr>
        <td>2</td>
        <td>dsa Doe</td>
        <td>jane@example.com</td>
      </tr>
	  
    </tbody>
  </table>

  <!-- Pagination -->
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-end">
      <!-- Pagination links will be dynamically generated here -->
    </ul>
  </nav>

</div>

<!-- Bootstrap JS and Popper.js (required for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JavaScript for search, entries per page, and pagination -->
<script>
  var entriesPerPage = 5; // Default number of entries per page
  var currentPage = 1; // Default current page

  function searchTable() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search");
    filter = input.value.toUpperCase();
    table = document.getElementById("dataTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      // Assuming you want to search in the second column (index 1), adjust as needed
      td = tr[i].getElementsByTagName("td")[1];

      if (td) {
        txtValue = td.textContent || td.innerText;

        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }

    currentPage = 1; // Reset current page after searching
    updatePagination();
  }

  function changeEntriesPerPage() {
    var select = document.getElementById("entriesPerPage");
    entriesPerPage = parseInt(select.value);
    currentPage = 1;
    updateTable();
  }

  function updateTable() {
    var table = document.getElementById("dataTable");
    var tr = table.getElementsByTagName("tr");

    var startIndex = (currentPage - 1) * entriesPerPage;
    var endIndex = startIndex + entriesPerPage;

    for (var i = 0; i < tr.length; i++) {
      if (i >= startIndex && i < endIndex) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }

    updatePagination();
  }

  function updatePagination() {
    var table = document.getElementById("dataTable");
    var tr = table.getElementsByTagName("tr");
    var totalPages = Math.ceil(tr.length / entriesPerPage);

    var pagination = document.querySelector(".pagination");
    pagination.innerHTML = "";

    for (var i = 1; i <= totalPages; i++) {
      var li = document.createElement("li");
      li.className = "page-item" + (i === currentPage ? " active" : "");
      var a = document.createElement("a");
      a.className = "page-link";
      a.href = "#";
      a.innerText = i;
      a.addEventListener("click", function (event) {
        event.preventDefault();
        currentPage = parseInt(event.target.innerText);
        updateTable();
      });
      li.appendChild(a);
      pagination.appendChild(li);
    }
  }

  // Call updateTable after adding or removing rows to initialize the table
  updateTable();
</script>

</body>
</html>

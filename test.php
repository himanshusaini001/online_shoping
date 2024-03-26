<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Active Nav Bar</title>
  <link rel="stylesheet" href="styles.css">

  <style>
    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
    }

    nav ul li {
      display: inline;
    }

    nav ul li a {
      text-decoration: none;
      padding: 10px 20px;
      color: black;
    }

    nav ul li a.active {
      color: yellow; /* Change text color for active link */
    }
  </style>
</head>
<body>
  <nav>
    <ul>
      <li><a href="#" class="active" onclick="changeActive(this)">Home</a></li>
      <li><a href="#" onclick="changeActive(this)">About</a></li>
      <li><a href="#" onclick="changeActive(this)">Services</a></li>
      <li><a href="#" onclick="changeActive(this)">Contact</a></li>
    </ul>
  </nav>

  <script src="script.js"></script>
  <script>
    function changeActive(element) {
      // Remove 'active' class from all links
      var links = document.querySelectorAll('nav ul li a');
      links.forEach(function(link) {
        link.classList.remove('active');
      });

      // Add 'active' class to the clicked link
      element.classList.add('active');
    }
  </script>
</body>
</html>

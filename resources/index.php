<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resource Home Page</title>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f8f8;
      color: #333;
    }

    header {
        background-color: #3498db; /* Dodger Blue */
        color: #fff; /* White text color */
        padding: 20px;
        text-align: center;
        height:120px;
        border:black solid;
    }

    nav {
        width: 200px;
        background-color: #1976D2; /* Emerald Green */
        padding: 10px;
        float: left;
        box-sizing: border-box;
        list-style: none;
        color: #fff; /* White text color */
        border-radius: 10px;
        border:black solid;
    }

    nav ul {
        list-style: none; /* Remove default list-style */
        padding: 10px;
        margin: 0;
    }

    nav a {
        display: block;
        color: #fff; /* Midnight Blue text color */
        text-decoration: none;
        
        padding: 10px;
        margin-bottom: 5px;
        border-radius: 5px;
        background-color: ##1976D2; /* Clouds background color */
        transition: background-color 0.3s ease;
    }

    nav a:hover {
        background-color: #bdc3c7; /* Silver background color on hover */
        color: #000; /* Black text color on hover */
    }

    main {
      margin-left: 220px;
      padding: 20px;
      box-sizing: border-box;
    }

    button {
      padding: 10px;
      background-color: #2196F3;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0b7dda;
    }

    .instructions-container {
        background-color: #f2f4f8; /* Light white background */
        color: #4a4e69; /* Violet-blue text color */
        padding: 20px;
        border: #4a4e69 solid;
        border-radius: 10px;
        margin-bottom: 20px;
        text-align: center;
        margin: 40vh;
        margin-top: 10px;
    }

    .instructions-header {
        font-size: 1.5em;
        margin-bottom: 10px;
        color: #4a4e69; /* Violet-blue header text color */
    }

    .instructions-list {
        list-style: none; /* Remove default bullet point */
        padding: 0;
        margin-left: 0; /* Ensure starting point for each list item is the same */
    }

    .instructions-list li {
        margin-bottom: 10px;
        position: relative;
        text-align: left;
        padding-left: 30px; /* Align text to the left within each list item */
    }

    .instructions-list li::before {
        content: '\2022'; /* Unicode character for a point (•) */
        color: #4a4e69; /* Violet-blue bullet point color */
        display: inline-block;
        width: 1em;
        margin-left: -1.5em; /* Adjusted margin to align with the text */
        position: absolute;
    }

    .instructions-header {
        background-color: #1a237e;
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    hr {
        border: 1px solid #ddd; 
        margin-top: 20px;
        margin-bottom: 20px;
    }

    button {
        padding: 10px;
        background-color: #2196F3;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0b7dda;
    }

    @media screen and (max-width: 768px) {
        nav {
            width: 100%;
            float: none;
            margin-bottom: 10px;
        }

        main {
            margin-left: 0;
        }

        .instructions-container {
            margin: 10px;
        }
    }

    @media screen and (max-width: 1024px) {
        .instructions-container {
            max-width: 80%; /* Adjust the width for tablets as needed */
            margin: 10px auto; /* Center the container */
        }
    }

  </style>
</head>
<body>
  <header>
    <h1>Welcome to Resources Home Page</h1>
    <p>&copy Mayank Mahajan, Research Associate</p>
    <p>Harvard Business School</p>
  </header>
<hr>
  <nav>
    <ul>
      <li><a href="#" onclick="showContent('QR Generation')">QR Generation</a></li>
      <li><a href="#" onclick="showContent('Link Management')">Link Management</a></li>
      <li><a href="#" onclick="showContent('Ranon Code')">Ranon Code</a></li>
      <li><a href="#" onclick="showContent('yt-playlist parser')">Playlist link Parser</a></li>
      <li><a href="#" onclick="showContent('clear-temp-files')">Temporary Files</a></li>
      <li><a href="#" onclick="showContent('lab-management')">Lab Management</a></li>
      <li><a href="#" onclick="showContent('Option 7')">Option 7</a></li>
      <li><a href="#" onclick="showContent('Option 8')">Option 8</a></li>
      <li><a href="#" onclick="showContent('Option 9')">Option 9</a></li>
      <li><a href="#" onclick="showContent('Option 10')">Option 10</a></li>
    </ul>
  </nav>

  <main>
    <div id="content">
      
    </div>

    <div class="instructions-container" id="instructions-container" style="display: none;">
      <h2 class="instructions-header">Instructions</h2>
      <hr>
      <ul class="instructions-list" id="instructions-list"></ul>
      <hr>
      <button onclick="proceed()">Proceed</button>
    </div>
  </main>

  <script>
    let selectedOption = ''; // Variable to store the selected option

    function showContent(option) {
      selectedOption = option; // Store the selected option
      let info = [];
      switch (option) {
        case 'QR Generation':
          info = [
            "Enter your content or link.",
            "Preview the QR code.",
            "Click Scan QR Code'.",
            "Download  QR code.",
            "UPI Id is not allowed",
            "after 4 Hours QR will be erased from server",
          ];
          break;
        case 'Link Management':
          info = [
            "Upload the Links got from Share Option",
            "View and organize your links",
            "Note down the timestamp of the video before saving the notes",
            "Add a new link with Topic for Quick Recap",
            "Centralized TO-DO for View only",
            "Save the Notes after viewing the video",
            "Use <b>BOLD</b> inplace of Highlighting",
            "Delete existing links.",
          ];
          break;
        case 'Ranon Code':
          info = [
            "Write Your Code according statement in <strong><u> C,C++, Python only.</u></strong>",
            "Problem should be solved within specified time",
            "Based on the Test Case of the problem your code will be evaluated",
          ];
          break;
        case 'yt-playlist parser':
          info = [
            "In the redirected site paste the URL of the playlist",
            "This is open-source web site",
            "Redirected Web Page is not related to LMS server",
            "Soon we will program that in our server",
            "please be patient",
          ];
          break;
        case 'clear-temp-files':
          info = [
            "Please Download the files if needed",
            "Once Deleted, No possibility to recover from server",
          ];
          break;
        case 'lab-management':
          info = [
            "Maintain the Lab Files in order with Date",
            "Dont edit unneccessarily after deadline",
          ];
          break;
          default:
          info = ["Page under construction<br>contact for suggestions<br><em><b>mayank.mahajan@hbs.harvard.edu</b></em>"];
      }

      const instructionsContainer = document.getElementById('instructions-container');
      const instructionsList = document.getElementById('instructions-list');

      if (info.length > 0) {
        instructionsContainer.style.display = 'block';
        instructionsList.innerHTML = info.map(instruction => `<li>${instruction}</li>`).join('');
      } else {
        instructionsContainer.style.display = 'none';
      }
    }

    function proceed() {
      if (selectedOption === 'QR Generation') {
        alert('Redirect to QR Generation page.');
        window.open('qr-gen/qr_gen.php','_blank');
      } else if (selectedOption === 'Link Management') {
        window.location.href = 'link-mgnt/index.php';
      } else if (selectedOption === 'Ranon Code'){
        alert('Page under Experiment');
        window.open('ranon-codex/index.html');
      } else if (selectedOption === 'yt-playlist parser'){
        alert('Redirecting to another site..');
        window.location.href = 'https://technmind.com/youtube-playlist-link-extractor/';
      } else if (selectedOption === 'clear-temp-files'){
        alert('Initiating Maintainence Mode');
        window.location.href = '../maintainence/clear-logs.php';
      } else if( selectedOption === 'lab-management'){
        alert('Initiating Lab Mode');
        window.location.href = '#';
      }

      else {
        alert('Redirect to the page linked to the selected option.');
      }
    }
  </script>

</body>
</html>

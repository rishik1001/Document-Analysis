<!DOCTYPE html>
<html>
<head>
    <title>Home page</title>
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" href="https://pyscript.net/latest/pyscript.css" />
    <script defer src="https://pyscript.net/latest/pyscript.js"></script>
    <style>
        /* Style for the circular loading indicator */
        /*
        .loader {
            border: 4px solid #f3f3f3; 
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
            margin: 10px auto;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        } 
        */

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black */
            z-index: 9999; /* A high value to make sure it's on top */
            display: none; /* Hide it by default */
        }


        .loader {
            border: 16px solid #f3f3f3; /* Grey */
            border-top: 16px solid #3498db; /* Blue */
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: fixed;
            left: 48%;
            top: 40%;
            transform: translate(-50%, -50%);
            z-index: 1;
            display: none;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        

    </style>
</head>
<body>
    <header>
        <!--<div class="logo">
      <img src="logo.png" alt="Logo">
      <h3></h3>
    </div>-->
        <nav>
            <ul>
                <l1 class="title"> <a style="color:white"> DocScanalytics</a></l1>
            </ul>
        </nav>
    </header>
    <div class="overlay"></div>
    <div class="main2">
        <div class="main21">
            <form id="file">
                <input type="file" id="filepicker" accept=".txt" required />
                <input type="submit" onclick="return readfile()" />
                <!-- <button onclick = "readFile()">Submit</button> -->
            </form>
        </div>
        <div class="main22">
            <div class="loader"></div>
            <div id="output"></div>
        </div>
    </div>
    <script>
        function readfile() {
            event.preventDefault();
            const fileInput = document.querySelector('input[type="file"]');
            const file = fileInput.files[0];
            alert(file);
            const reader = new FileReader();
            reader.onload = (event) => {
                const fileContents = event.target.result;
                const lines = fileContents.split('\n');
                const outputDiv = document.getElementById("output");

                // Create a new loading indicator element
                // const loadingIndicator = document.createElement("div");
                // loadingIndicator.className = "loader";
                // outputDiv.appendChild(loadingIndicator);
                const overlay = document.querySelector('.overlay');
                overlay.style.display = 'block'; // Show the overlay
                document.querySelector('.loader').style.display = 'block';

                const xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // Remove the loading indicator
                        // outputDiv.removeChild(loadingIndicator);

                        // Display the response text
                        // document.getElementById("output").innerHTML = this.responseText;
                        document.getElementById("output").innerHTML = this.responseText;
                        document.querySelector('.loader').style.display = 'none';
                        overlay.style.display = 'none'; // Hide the overlay

                    }
                };
                xhttp.open("POST", "noun0.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("fileContents=" + encodeURIComponent(fileContents));
            };
            reader.readAsText(file);
        }
    </script>
    
</body>
</html>

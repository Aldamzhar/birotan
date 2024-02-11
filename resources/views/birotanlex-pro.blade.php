<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <!-- For Mammoth.js (DOCX files) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>
    <!-- For PDF.js (PDF files) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.7.570/pdf.min.js"></script>

    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family="ADLaM Display"' rel='stylesheet'>
    <link rel="icon" type="image/png" href="/storage/img_4.png">
    <title>BirOtan</title>
</head>
<body>
<header>
    <a href="{{ url('/about') }}" class="menu-item">Сайт туралы</a>
    <div class="dropdown">
        <a href="{{ url('/birotanlex') }}" class="menu-item">БірОтан лексика</a>
        <div class="dropdown-content">
            <a href="{{ url('/birotanlex-pro') }}" class="menu-item">БірОтан лекc-pro</a>
        </div>
    </div>
    <a href="{{ url('/mypage') }}" class="menu-item"><img src="/storage/img_8.png"></a>
    <a href="{{ url('/technews') }}" class="menu-item">Tech+Жаңалық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан әуені</a>
</header>

<div class="container">
    <div class="textarea-container">
        <input type="text" id="username" name="username" placeholder="Пайдаланушының аты" required>
        <input type="text" id="textTitle" name="textTitle" placeholder="Мәтін тақырыбы" required>
        <textarea class="input" placeholder="Мәтінді енгізіңіз..."></textarea>
        <div class="textarea-footer">
            <span>0/150000</span>
            <div class="icons">
                <button id="pasteTextButton">📋</button> <!-- You can replace this with the actual icon -->
            </div>
            <input type="file" id="fileInput" accept=".txt,.pdf,.doc,.docx" style="display: none;" />
        </div>
    </div>
    <div class="textarea-container">
        <div class="output" contenteditable="false"></div>
{{--        <textarea class="output" readonly></textarea>--}}
        <div class="buttons">
            <button>БОЛ</button>
            <button>Сөздер мен қайталану</button>
            <button>Жаңа + қате сөздер</button>
        </div>
    </div>
</div>
<div class="bottom-buttons">
{{--    <button id="baskatBaseFillingButton">Басқат базасың толтыру</button>--}}
    <button id="downloadButton">Нәтижелерді жүктеу</button>
</div>

{{--@include('footer')--}}



</body>
</html>

<style>

    /*a {*/
    /*    align-items: center;*/
    /*}*/

    /*img {*/
    /*    width: 40%;*/
    /*    height: 40%;*/
    /*}*/

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: tan;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: white;
        padding: 10px 0;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
    }

    @font-face {
        font-family: 'ADLaMDisplay-Regular'; /* A name for your font that will be used in CSS */
        src: url('public/assets/ADLaMDisplay-Regular.ttf') format('truetype'); /* URL to your font file in your project, and the format */
        /* Optional: add font-weight and font-style properties if you have variations of the font (like bold or italic) */
        font-weight: normal;
        font-style: normal;
    }


    h1 {
        font-family: ADLaMDisplay-Regular, sans-serif;
        font-size: 35px;
        color: #0277BD; /* Change this color to match your design */
        margin: 0;
    }

    /* Style the dropdown container */
    .dropdown {
        display: inline-block;
    }

    /* Style the dropdown button */
    .dropbtn {
        display: inline-block; /* Sets the element's display to inline-block */
        white-space: nowrap; /* Prevents the text from wrapping */
        overflow: hidden; /* Keeps the content from spilling out */
        text-overflow: ellipsis; /* Adds an ellipsis if the text is too long to fit */
        text-align: center; /* Centers the content inside the anchor */
        vertical-align: top; /* Aligns the anchor with the top of the line */
        /*display: flex; !* Enables flexbox *!*/
        justify-content: center; /* Centers horizontally */
        align-items: center; /* Centers vertically */
        height: 100%; /* You might need to adjust this */
        text-decoration: none;
        color: #2A0FA9;
        margin: 0 10px;
        font-size: 25px;
        font-weight: bold;
    }

    /* Dropdown content (hidden by default) */
    .dropdown-content {
        display: none;
        position: absolute;
        background-color: white; /* Light grey background */
        /*z-index: 1;*/
    }

    /* Links inside the dropdown */
    .dropdown-content a {
        display: inline-block; /* Sets the element's display to inline-block */
        white-space: nowrap; /* Prevents the text from wrapping */
        overflow: hidden; /* Keeps the content from spilling out */
        text-overflow: ellipsis; /* Adds an ellipsis if the text is too long to fit */
        text-align: center; /* Centers the content inside the anchor */
        vertical-align: top; /* Aligns the anchor with the top of the line */
        /*display: flex; !* Enables flexbox *!*/
        justify-content: center; /* Centers horizontally */
        align-items: center; /* Centers vertically */
        height: 100%; /* You might need to adjust this */
        text-decoration: none;
        color: #2A0FA9;
        margin: 0 10px;
        font-size: 25px;
        font-weight: bold;
    }

    /* Change color of dropdown links on hover */
    .dropdown-content a:hover {background-color: white}

    /* Show the dropdown menu on hover */
    .dropdown:hover .dropdown-content {
        display: block;
    }

    /* Change the background color of the dropdown button when the dropdown content is shown */
    .dropdown:hover .dropbtn {
        background-color: white; /* Darker green */
    }

    .menu-item {
        display: inline-block; /* Sets the element's display to inline-block */
        white-space: nowrap; /* Prevents the text from wrapping */
        overflow: hidden; /* Keeps the content from spilling out */
        text-overflow: ellipsis; /* Adds an ellipsis if the text is too long to fit */
        text-align: center; /* Centers the content inside the anchor */
        vertical-align: top; /* Aligns the anchor with the top of the line */
        /*display: flex; !* Enables flexbox *!*/
        justify-content: center; /* Centers horizontally */
        align-items: center; /* Centers vertically */
        height: 100%; /* You might need to adjust this */
        text-decoration: none;
        color: #2A0FA9;
        margin: 0 10px;
        font-size: 25px;
        font-weight: bold;
    }

    .menu-item img {
        max-width: 100%; /* Ensures the image is not bigger than the container */
        height: auto; /* Maintains the aspect ratio */
        width: auto; /* Sets the image width to auto */
        /*height: auto; !* Sets the image height to auto *!*/
        max-height: 90px; /* Adjust the max-height to match the surrounding elements */
        vertical-align: top; /* Aligns the image with the top of the line */
    }

    .menu-item:hover {
        text-decoration: underline;
    }


    .container {
        display: flex;
        gap: 20px;
        justify-content: center;
    }

    .textarea-container {
        margin-top: 35px;
        width: 40%;
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        min-height: 500px;
    }

    textarea {
        border: none;
        border-radius: 5px;
        /*padding: 10px;*/
        font-size: 14px;
        width: 100%;
        height: 400px; /* adjust as needed */
        resize: none;
    }

    input[type=text] {
        border: none;
        border-radius: 5px;
        font-size: 14px;
        width: 100%;
        /*padding: 10px;*/
        margin-bottom: 10px; /* adds space between the inputs */
        /*box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1); !* adds a subtle shadow like the textarea *!*/
        resize: none;
    }

    .not-in-baskat {
        color: red;
        font-weight: bold;
    }

    .output {
        /* Add the same styles as your textarea */
        white-space: pre-wrap;
        word-wrap: break-word;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 5px;
        /*padding: 10px;*/
        font-size: 14px;
        width: 100%;
        height: 400px; /* Adjust as needed */
        overflow: auto;
        background-color: #fff;
        /*margin-top: 35px;*/
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }



    .textarea-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 10px;
    }

    .icons button {
        background: none;
        border: none;
        font-size: 16px;
        cursor: pointer;
    }

    #downloadButton {
        padding: 20px 40px; /* Increase padding to make button larger */
        font-size: 1.1em; /* Increase font size */
    }


    .buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
    }

    button {
        border: none;
        background-color: #F7C45F;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #F7B042;
    }

    .bottom-buttons {
        display: flex;
        gap: 20px;
        margin-top: 20px;
        margin-bottom: 20px;
        justify-content: center;
    }

    .underline-error {
        text-decoration: underline wavy red; /* Creates a wavy underline */
    }



</style>

<script>

    const results = {
        bol: '',
        wordRepetition: '',
        errorWords: ''
    };

    document.addEventListener("DOMContentLoaded", function() {
        const textarea = document.querySelector(".textarea-container textarea");
        const wordCountSpan = document.querySelector(".textarea-footer span");
        const errorDiv = document.createElement('div'); // Create a new div for the error message
        errorDiv.style.color = 'red'; // Set the error message color to red
        errorDiv.style.paddingTop = '10px';
        textarea.parentNode.insertBefore(errorDiv, textarea.nextSibling); // Insert the error div after the textarea

        textarea.addEventListener("input", function() {
            const words = textarea.value.split(/[\s,.;:]+|(?<!\S)[,.:;!?+_/-]+(?!\S)|(?<=\s)[-–](?=\s)/)
                                        .map(word => word.trim())
                                        .filter(word => word.length > 0 && !/^[-–]+$/.test(word));
            const wordCount = words.length;

            wordCountSpan.textContent = `${wordCount}/150000`;

            if (wordCount > 150000) {
                errorDiv.textContent = "Қате! Мәтін көлемін азайтыңыз, шекті саны - 150000 сөз"; // Display the error message
                const limitedWords = words.slice(0, 150000).join(" ");
                textarea.value = limitedWords; // Limit the text to 5000 words
            } else {
                errorDiv.textContent = ''; // Clear the error message when under the limit
            }
        });

    });


    document.addEventListener('DOMContentLoaded', function() {
        // Elements
        const textarea = document.querySelector('.textarea-container textarea');
        const textarea_output = document.querySelector('.output');
        const bolButton = document.querySelector('.buttons button:nth-child(1)');
        const wordStatsButton = document.querySelector('.buttons button:nth-child(2)');
        const errorWordsButton = document.querySelector('.buttons button:nth-child(3)');

        // Event Listeners
        bolButton.addEventListener('click', async () => {
            const text = textarea.value;
            try {
                const response = await fetch('/api/pro-analyze-text', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // For CSRF protection in Laravel
                    },
                    body: JSON.stringify({ text }),
                });

                if (response.ok) {
                    const data = await response.json();
                    const outputDiv = document.querySelector('.output'); // Make sure .output is the class for your div
                    outputDiv.innerHTML = `Мәтіндегі сөздер саны: ${data.totalWords}<br><br>Бірегей сөздер саны: ${data.uniqueWords}<br><br>Мәтіннің сөз байлығы: ${data.percentageUnique.toFixed(2)}%`;
                    results.bol = outputDiv.innerHTML;
                } else {
                    console.error('Error analyzing text', await response.text());
                }
            } catch (err) {
                console.error('There was an error:', err);
            }

        });

        wordStatsButton.addEventListener('click', async () => {
            const text = textarea.value;
            try {
                const response = await fetch('/api/pro-words-and-occurrences', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        // 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // For CSRF protection in Laravel
                    },
                    body: JSON.stringify({ text }),
                });

                if (response.ok) {
                    const data = await response.json();
                    const outputDiv = document.querySelector('.output'); // Make sure .output is the class for your div
                    let output = "Мәтіндегі сөздердің қайталану жиілігі:<br><br>";
                    for (const word in data.wordRepetitions) {
                        output += `${word}: ${data.wordRepetitions[word]} рет<br>`;
                    }
                    outputDiv.innerHTML = output;
                    results.wordRepetition = outputDiv.innerHTML;
                } else {
                    console.error('Error fetching word repetition stats', await response.text());
                }
            } catch (err) {
                console.error('There was an error:', err);
            }

        });


        // You can continue this pattern for the 'Жана + қате создер' button.
            // For instance, fetching errors or unique words and appending to the textarea as needed.
        errorWordsButton.addEventListener('click', function() {
            const text = textarea.value;

            fetch('/api/pro-check-baskats', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ text: text })
            })
                .then(response => response.json())
                .then(wordsNotInBaskats => {
                    console.log('Words not in Baskat:', wordsNotInBaskats);
                    const punctuation = /[.,/#!?«»$%^&*;:{}=-\_`~()]/g;
                    const englishOrNumber = /^[A-Za-z0-9]+$/; // Regular expression for English words or numbers
                    const words = text.split(/\s+/);
                    const formattedText = words.map(word => {
                        // Remove punctuation from the beginning and end of the word for checking
                        const cleanWord = word.replace(punctuation, '');

                        // Check if the cleaned word is in the list of words not in Baskat and not English or a number
                        if (wordsNotInBaskats.includes(cleanWord) && !englishOrNumber.test(cleanWord)) {
                            // Wrap the original word (with punctuation) in a span with class for styling
                            return `<span class="not-in-baskat">${word}</span>`;
                        } else {
                            // Keep the original word (with punctuation)
                            return word;
                        }
                    }).join(' '); // Re-join the words into a single string

                    const outputDiv = document.querySelector('.output');
                    outputDiv.innerHTML = formattedText; // Set the HTML content of the output div
                    results.errorWords = outputDiv.innerHTML;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

    });
        // Your jsPDF related code here
    function downloadWordDocument() {
        var header = "<html xmlns:o='urn:schemas-microsoft-com:office:office' " +
            "xmlns:w='urn:schemas-microsoft-com:office:word' " +
            "xmlns='http://www.w3.org/TR/REC-html40'>" +
            "<head><style>.not-in-baskat { color: red; }</style>" +
            "<meta charset='utf-8'></head><body>";
        var footer = "</body></html>";
        const username = document.getElementById('username').value;
        const textTitle = document.getElementById('textTitle').value;

        var sourceHTML = header +
            `<b>Пайдаланушының аты:</b> ${username}<br><b>Мәтіннің аты:</b> ${textTitle}` +
            `<br><br><b>БОЛ:<br></b> ${results.bol}<br><br><b>Сөздер мен қайталану:<br></b> ${results.wordRepetition}` +
            `<br><br><b>Жаңа + қате сөздер:<br></b> ${results.errorWords}` + footer;

        var source = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(sourceHTML);
        var fileDownload = document.createElement("a");
        document.body.appendChild(fileDownload);
        fileDownload.href = source;
        fileDownload.download = 'document.doc';
        fileDownload.click();
        document.body.removeChild(fileDownload);
    }

    // Add the above function to the event listener of your download button
    document.getElementById('downloadButton').addEventListener('click', downloadWordDocument);




    document.getElementById('pasteTextButton').addEventListener('click', function() {
        // Trigger the file input when the button is clicked
        document.getElementById('fileInput').click();
    });

    document.getElementById('fileInput').addEventListener('change', async function(event) {
        const file = event.target.files[0];
        const wordCountSpan = document.querySelector(".textarea-footer span");
        const inputTextarea = document.querySelector('.textarea-container .input');

        if (!file) {
            console.error("No file was selected.");
            return;
        }

        if (file.type === "text/plain") {
            // Handle .txt files natively
            const reader = new FileReader();
            reader.onload = function(e) {
                const text = e.target.result;
                displayText(text);
            };
            reader.onerror = function() {
                console.error("Error reading the text file.");
            };
            reader.readAsText(file);
        } else if (file.type === "application/pdf") {
            // Use pdf.js for PDFs
            readPdfFile(file);
        } else if (file.type === "application/vnd.openxmlformats-officedocument.wordprocessingml.document") {
            // Use mammoth.js for DOCX files
            readDocxFile(file);
        } else {
            console.error("Unsupported file type.");
        }

        function displayText(text) {
            inputTextarea.value = text;
            updateWordCount(text);
        }

        function updateWordCount(text) {
            const textarea = document.querySelector(".textarea-container textarea");
            const wordCountSpan = document.querySelector(".textarea-footer span");
            const errorDiv = document.createElement('div'); // Create a new div for the error message
            const words = textarea.value.split(/\s+/).filter(word => word.length > 0);
            const wordCount = words.length;

            wordCountSpan.textContent = `${wordCount}/150000`;

            if (wordCount > 150000) {
                errorDiv.textContent = "Қате! Мәтін көлемін азайтыңыз, шекті саны - 150000 сөз"; // Display the error message
                const limitedWords = words.slice(0, 150000).join(" ");
                textarea.value = limitedWords; // Limit the text to 5000 words
            } else {
                errorDiv.textContent = ''; // Clear the error message when under the limit
            }
        }

        async function readPdfFile(file) {
            const reader = new FileReader();
            reader.onload = async function(e) {
                const typedarray = new Uint8Array(e.target.result);

                const pdf = await pdfjsLib.getDocument({ data: typedarray }).promise;
                const firstPage = await pdf.getPage(1);
                const textContent = await firstPage.getTextContent();

                const text = textContent.items.map(item => item.str).join(' ');
                displayText(text);
            };
            reader.readAsArrayBuffer(file);
        }

        async function readDocxFile(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const arrayBuffer = e.target.result;

                mammoth.extractRawText({ arrayBuffer: arrayBuffer })
                    .then(function(result) {
                        const text = result.value;
                        displayText(text);
                    })
                    .catch(function(err) {
                        console.error(err);
                    });
            };
            reader.readAsArrayBuffer(file);
        }
    });


</script>

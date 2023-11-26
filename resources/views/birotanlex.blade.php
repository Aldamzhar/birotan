<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family="ADLaM Display"' rel='stylesheet'>
    <title>Website</title>
</head>
<body>
<header>
    <a href="{{ url('/about') }}" class="menu-item">Сайт туралы</a>
    <a href="{{ url('/birotanlex') }}" class="menu-item">БірОтан лексика</a>
    <a href="{{ url('/mypage') }}" class="menu-item"><img src="/storage/img_8.png"></a>
    <a href="{{ url('/technews') }}" class="menu-item">Tech + жаналық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан өуені</a>
</header>

<div class="container">
    <div class="textarea-container">
        <textarea class="input" placeholder="Insert your text..."></textarea>
        <div class="textarea-footer">
            <span>0/3000</span>
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
{{--    <button>Бастау</button>--}}
    <button id="downloadButton">Нәтижелерді жүктеу</button>
</div>

@include('footer')



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
        padding: 10px 30px;
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

    .menu-item {
        display: inline-block; /* Sets the element's display to inline-block */
        text-align: center; /* Centers the content inside the anchor */
        vertical-align: top; /* Aligns the anchor with the top of the line */
        /*display: flex; !* Enables flexbox *!*/
        justify-content: center; /* Centers horizontally */
        align-items: center; /* Centers vertically */
        height: 100%; /* You might need to adjust this */
        text-decoration: none;
        color: #444;
        margin: 0 10px;
        font-size: 14px;
    }

    .menu-item img {
        max-width: 100%; /* Ensures the image is not bigger than the container */
        height: auto; /* Maintains the aspect ratio */
        width: auto; /* Sets the image width to auto */
        /*height: auto; !* Sets the image height to auto *!*/
        max-height: 50px; /* Adjust the max-height to match the surrounding elements */
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
    }

    textarea {
        border: none;
        border-radius: 5px;
        /*padding: 10px;*/
        font-size: 14px;
        width: 100%;
        height: 200px; /* adjust as needed */
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
        height: 200px; /* Adjust as needed */
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

        textarea.addEventListener("input", function() {
            const words = textarea.value.split(/\s+/).filter(word => word.length > 0); // Split by spaces and filter out any empty strings
            const wordCount = words.length;

            wordCountSpan.textContent = `${wordCount}/3000`;

            if (wordCount > 3000) {
                wordCountSpan.style.color = "red";
                // Optionally: prevent further input beyond 3000 words
                const limitedWords = words.slice(0, 3000).join(" ");
                textarea.value = limitedWords;
            } else {
                wordCountSpan.style.color = ""; // reset to default color
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
                const response = await fetch('/api/analyze-text', {
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
                const response = await fetch('/api/words-and-occurrences', {
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

            fetch('/api/check-baskats', {
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
                    const words = text.split(/\s+/);
                    const formattedText = words.map(word => {
                        // Check if the word is in the list of words not in Baskat
                        if (wordsNotInBaskats.includes(word)) {
                            // Wrap the word in a span with class for styling
                            return `<span class="not-in-baskat">${word}</span>`;
                        } else {
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
            "<head><style>.not-in-baskat { color: red; font-weight: bold;}</style>" +
            "<meta charset='utf-8'></head><body>";
        var footer = "</body></html>";
        var sourceHTML = header + `Results:\n\nБОЛ: ${results.bol}\n\nСөздер мен қайталану: ${results.wordRepetition}\n\nЖаңа + қате сөздер: ${results.errorWords}` + footer;

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
        // Get the file from the input
        const file = event.target.files[0];
        if (file) {
            // Prepare the FormData object to send the file to the server
            const formData = new FormData();
            formData.append('file', file);

            // Fetch call to send the file to your Laravel backend
            try {
                const response = await fetch('/api/upload-file', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                // Set the extracted text into the textarea
                document.querySelector('.input').value = data.text;
            } catch (error) {
                console.error('Error:', error);
            }
        }
    });



</script>

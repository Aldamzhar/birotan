<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family="ADLaM Display"' rel='stylesheet'>
    <title>Website</title>
</head>
<body>
<header>
    <a href="{{ url('/about') }}" class="menu-item">Сайт туралы</a>
    <a href="{{ url('/birotanlex') }}" class="menu-item">БірОтан лексика</a>
    <a href="{{ url('/mypage') }}"><img src="/storage/img_4.png"></a>
    <a href="{{ url('/technews') }}" class="menu-item">Tech + жаналық</a>
    <a href="{{ url('/birotanauen') }}" class="menu-item">БірОтан өуені</a>
</header>

<div class="container">
    <div class="textarea-container">
        <textarea class="input" placeholder="Insert your text..."></textarea>
        <div class="textarea-footer">
            <span>0/3000</span>
            <div class="icons">
                <button>📋</button> <!-- You can replace this with the actual icon -->
            </div>
        </div>
    </div>
    <div class="textarea-container">
        <textarea class="output" readonly></textarea>
        <div class="buttons">
            <button>БОЛ</button>
            <button>Сөздер мен қайталану</button>
            <button>Жаңа + қате создер</button>
        </div>
    </div>
</div>
<div class="bottom-buttons">
    <button>Бастау</button>
    <button>Нәтижелер жүктеу</button>
</div>

@include('footer')



</body>
</html>

<style>
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
        text-decoration: none;
        color: #444;
        margin: 0 10px;
        font-size: 14px;
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
        padding: 10px;
        font-size: 14px;
        width: 100%;
        height: 200px; /* adjust as needed */
        resize: none;
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
        justify-content: center;
    }

    .underline-error {
        text-decoration: underline wavy red; /* Creates a wavy underline */
    }



</style>

<script>
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
                    textarea_output.value = `Мәтіңдегі барлық сөздер саны: ${data.totalWords}\n\nБірегей сөздер саны: ${data.uniqueWords}\n\nБірегей сөздердің мәтіңдегі жалпы сөздердің санына пайыздық қатынасы: ${data.percentageUnique.toFixed(2)}%
                `;
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
                        let output = "Мәтіндегі сөздердің қайталану жиілігі:\n\n";
                        for (const word in data.wordRepetitions) {
                            output += `${word}: ${data.wordRepetitions[word]} рет\n`;
                        }
                        textarea_output.value = output;
                    } else {
                        console.error('Error fetching word repetition stats', await response.text());
                    }
                } catch (err) {
                    console.error('There was an error:', err);
                }
            });

            // You can continue this pattern for the 'Жана + қате создер' button.
            // For instance, fetching errors or unique words and appending to the textarea as needed.
            errorWordsButton.addEventListener('click', async() => {
                // This is a placeholder for what this function might do.
                // You'd have to define your backend API endpoint and expected return values.
                let text = textarea.value;

                // Make API call
                const response = await fetch('/api/check-words', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ text: text })
                });

                const data = await response.json();

                // Highlight error words in text
                data.errors.forEach(errorWord => {
                    const regex = new RegExp(`\\b${errorWord}\\b`, 'g');
                    text = text.replace(regex, `<span style="text-decoration: red wavy underline;">${errorWord}</span>`);
                });

                // Set the highlighted text back to the textarea
                textarea_output.innerHTML = text;
            });


    });

</script>


window.SpeechRecognition = window.webkitSpeechRecognition || window.SpeechRecognition;
const synth = window.speechSynthesis;
const recognition = new SpeechRecognition();
let finalTranscript = '';
recognition.interimResults = true;
recognition.maxAlternatives = 10;
recognition.continuous = true;

const recordIcon = document.querySelector('#recordButton');
const fileToUpload = document.querySelector('#fileToUpload');
const stopIcon = document.querySelector('#stopButton');
// const displayIcon = document.querySelector('#displayContent');
const generateIcon = document.querySelector('#generateArticle');
let paragraph = document.createElement('p');
let container = document.querySelector('#inputText');
container.appendChild(paragraph);
const sound = document.querySelector('.sound');
// let voiceText = ;





recordIcon.addEventListener('click', () => {
  sound.play();
  dictate();
});

stopIcon.addEventListener('click', () => {
  loadText();
  sound.play();
  recognition.stop();
  //document.querySelector("#voiceText") = "Lahiru";
});

// displayIcon.addEventListener('click', () => {
//   populatePre('uploads/nlp.txt');
// });

// send content to python backend




    
const dictate = () => {

  recognition.start();

  recognition.onresult = (event) => {
    let interimTranscript = '';
    for (let i = event.resultIndex, len = event.results.length; i < len; i++) {
      let transcript = event.results[i][0].transcript;
      if (event.results[i].isFinal) {
        finalTranscript += transcript;
      } else {
        interimTranscript += transcript;
      }
    }


    
    paragraph.textContent = finalTranscript+interimTranscript;


 // }}


  }
};

function populatePre(url) {
  var xhr = new XMLHttpRequest();
  xhr.onload = function () {
    // document.getElementById('contents').textContent = this.responseText;
    paragraph.textContent = this.responseText;
  };
  xhr.open('GET', url);
  xhr.send();
}

function loadText(){
  var loadedtext = document.getElementById("inputText").textContent;
  document.getElementById("voiceText").value = loadedtext;

}




// const speak = (action) => {
//   utterThis = new SpeechSynthesisUtterance(action());
//   synth.speak(utterThis);
// };






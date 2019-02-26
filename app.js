window.SpeechRecognition = window.webkitSpeechRecognition || window.SpeechRecognition;
const synth = window.speechSynthesis;
const recognition = new SpeechRecognition();
let finalTranscript = '';
recognition.interimResults = true;
recognition.maxAlternatives = 10;
recognition.continuous = true;

const recordIcon = document.querySelector('#recordButton');
const stopIcon = document.querySelector('#stopButton');
const displayIcon = document.querySelector('#displayContent');
let paragraph = document.createElement('p');
let container = document.querySelector('.text-box');
container.appendChild(paragraph);
const sound = document.querySelector('.sound');

recordIcon.addEventListener('click', () => {
  sound.play();
  dictate();
});

stopIcon.addEventListener('click', () => {
  sound.play();
  recognition.stop();
});

displayIcon.addEventListener('click', () => {
  populatePre('uploads/ReadMe.txt');
});

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





// const speak = (action) => {
//   utterThis = new SpeechSynthesisUtterance(action());
//   synth.speak(utterThis);
// };






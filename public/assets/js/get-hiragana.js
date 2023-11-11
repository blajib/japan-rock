let hiraganaLevel = document.getElementById('hiragana_level_choice');
let hiraganaGetButton = document.getElementById('get-hiragana');
let hiraganaGetRoute = document.getElementById('hiragana-get-route');
let roomajiShow = document.getElementById('roomaji-show');
let roomajiButtonShow = document.getElementById('hiragana_roomaji_show');
let hiraganaShow = document.getElementById('hiragana-show');
let hiraganaButtonShow = document.getElementById('hiragana_hiragana_show');
let hiraganaSoundAsset = document.getElementById('hiragana-get-sound');
let hiraganaSoundDownloadLink = document.getElementById('hiragana-sound-download-link');
let hiraganaSound = document.getElementById('hiragana-sound');
let hiraganaButtonSound = document.getElementById('hiragana_hiragana_sound');
let hiraganaBlock = document.getElementById('hiragana-block');
let hiraganas = null;

roomajiButtonShow.checked = false;
hiraganaButtonShow.checked = false;

//Permet de récupérer les hirganas par rapport au level choisi
hiraganaLevel.addEventListener('change', async function () {
  let response = await fetch(hiraganaGetRoute.value + '/' + hiraganaLevel.value);

  if (response.ok) {
    hiraganas = await response.json();
    hiraganaGetButton.type = 'button';
    hiraganaBlock.hidden = false;
  } else {
    alert('HTTP-Error: ' + response.status);
  }
});

const nextHiragana = () => {
  const randomIndex = Math.floor(Math.random() * hiraganas.length);
  let hiragana = hiraganas[randomIndex];
  roomajiShow.innerHTML = hiragana['roomaji'];
  hiraganaShow.innerHTML = hiragana['hiragana'];
  hiraganaSound.src = hiraganaSoundAsset.value + hiragana['roomaji'] + '.mp3';
  if (hiraganaButtonSound.checked) {
    hiraganaSound.play();
  }
};

//afficher un hirgana au hazard
hiraganaGetButton.addEventListener('click', function () {
  nextHiragana();

});

hiraganaButtonShow.addEventListener('change', function () {
  hiraganaShow.hidden = hiraganaButtonShow.checked !== true;
});

roomajiButtonShow.addEventListener('change', function () {
  roomajiShow.hidden = roomajiButtonShow.checked !== true;
});

hiraganaButtonSound.addEventListener('change', function () {
  hiraganaSound.hidden = hiraganaButtonSound.checked !== true;
});

document.addEventListener('keypress', function (e) {
  if (e.key === 'Enter' || e.key === 'Space') {
    if (hiraganaBlock.hidden === false) {
      nextHiragana();
    }
  }
});

//TODO factoriser le change Show



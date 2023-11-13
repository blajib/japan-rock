//Le select permettant de choisir le niveau
let hiraganaLevel = document.getElementById('hiragana_level_choice');
// bouton permettant de récupérer un nouvel Hiragana
let hiraganaGetButton = document.getElementById('get-hiragana');
//Groupe label/input a afficher après avoir sélectionné le level
let hiraganaGroupLevel = document.getElementById('hiragana-group-select');
//Case à cocher permettant de faire le choix de n'avoir qu'un groupe
let hiraganaGetGroupButton = document.getElementById('hiragana_hiragana_select_group');
//Element html hidden avec en valeur la route perttant d'effectuer la requête ajax
let hiraganaGetRoute = document.getElementById('hiragana-get-route');
//Element html hidden avec en valeur la route perttant d'effectuer la requête ajax
let hiraganaGetGroupRoute = document.getElementById('hiragana-get-group-route');
//H1 d'affichage de l'hiragana en roomaji
let roomajiShow = document.getElementById('hiragana_roomaji_show_field');
//case à cocher permettant l'affichage ou non du roomaji
let roomajiButtonShow = document.getElementById('hiragana_roomaji_show');
//H1 d'affichage de l'hiragana en hiragana
let hiraganaShow = document.getElementById('hiragana_hiragana_show_field');
//case à cocher permettant l'affichage ou non de l'hiragana
let hiraganaButtonShow = document.getElementById('hiragana_hiragana_show');
//Élement html hidden avec en valeur le chemin pour récupérer le path des assets
let hiraganaSoundAsset = document.getElementById('hiragana-get-sound');
//case à cocher permettant d'écouter le son ou non de l'hiragana
let hiraganaButtonSound = document.getElementById('hiragana_hiragana_sound');
//Lecteur son
let hiraganaSound = document.getElementById('hiragana_hiragana_sound_field');
//Block avec hiragana, roomaji et le lecteur son
let hiraganaBlock = document.getElementById('hiragana-block');
//Liste des hiraganas à afficher
let hiraganas = null;
//Les case à cocher des paramètres d'affichages de l'hiragana
let hiraganaCheckboxes = document.getElementsByClassName('hiragana-checkbox');

let playButtonHiraganaSound = document.getElementById('play-hiragana-sound');

const init = () => {
  hiraganaLevel.selectedIndex = 0;
  hiraganaGetGroupButton.checked = false;
  for (let checkbox of hiraganaCheckboxes) {
    checkbox.checked = false;
    let element = document.getElementById(checkbox.id + '_field');
    checkbox.addEventListener('change', function () {
      element.hidden = checkbox.checked !== true;
    });
  }
};

//Permet de récupérer les hirganas par rapport au level choisi
const initAllHirganas = async () => {
  if (hiraganaLevel.value === '') {
    hiraganaGetButton.hidden = true;
    return;
  } else {
    hiraganaGetButton.hidden = false;
    hiraganaGroupLevel.hidden = false;
    hiraganaGetGroupButton.checked = false;
  }

  let response = await fetch(hiraganaGetRoute.value + '/' + hiraganaLevel.value);

  if (response.ok) {
    hiraganas = await response.json();
    hiraganaGetButton.type = 'button';
    hiraganaBlock.hidden = false;
  } else {
    alert('HTTP-Error: ' + response.status);
  }
};

//Permet de récupérer les groupes d'hirganas par rapport au level choisi
const initGroupHiraganas = async (element) => {
  let response = await fetch(hiraganaGetGroupRoute.value + '/' + hiraganaLevel.value);
  if (response.ok) {
    hiraganas = null;
    hiraganas = await response.json();
  } else {
    alert('HTTP-Error: ' + response.status);
  }
};

init();

hiraganaLevel.addEventListener('change', async function () {
  await initAllHirganas();
});

hiraganaGetGroupButton.addEventListener('change', async function () {
  if (this.checked === true) {
    await initGroupHiraganas(this);
  } else {
    await initAllHirganas();
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

document.addEventListener('keypress', function (e) {
  if (e.key === 'Enter' || e.key === 'Space') {
    if (hiraganaBlock.hidden === false) {
      nextHiragana();
    }
  }
});

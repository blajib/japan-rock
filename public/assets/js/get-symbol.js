//Le select permettant de choisir le niveau
let symbolLevel = document.getElementById('symbol_level_choice');
// bouton permettant de récupérer un nouvel Symbol
let symbolGetButton = document.getElementById('get-symbol');
//Groupe label/input a afficher après avoir sélectionné le level
let symbolGroupLevel = document.getElementById('symbol-group-select');
//Case à cocher permettant de faire le choix de n'avoir qu'un groupe
let symbolGetGroupButton = document.getElementById('symbol_symbol_select_group');
//Element html hidden avec en valeur la route perttant d'effectuer la requête ajax
let symbolGetRoute = document.getElementById('symbol-get-route');
//Element html hidden avec en valeur la route perttant d'effectuer la requête ajax
let symbolGetGroupRoute = document.getElementById('symbol-get-group-route');
//H1 d'affichage de l'symbol en roomaji
let roomajiShow = document.getElementById('symbol_roomaji_show_field');
//case à cocher permettant l'affichage ou non du roomaji
let roomajiButtonShow = document.getElementById('symbol_roomaji_show');
//H1 d'affichage de l'symbol en symbol
let symbolShow = document.getElementById('symbol_symbol_show_field');
//case à cocher permettant l'affichage ou non de l'symbol
let symbolButtonShow = document.getElementById('symbol_symbol_show');
//Élement html hidden avec en valeur le chemin pour récupérer le path des assets
let symbolSoundAsset = document.getElementById('symbol-get-sound');
//case à cocher permettant d'écouter le son ou non de l'symbol
let symbolButtonSound = document.getElementById('symbol_symbol_sound');
//Lecteur son
let symbolSound = document.getElementById('symbol_audio');
// Bouton play pour le plauer audio
let symbolPlaySoundButton = document.getElementById('symbol_symbol_sound_field');
//Block avec symbol, roomaji et le lecteur son
let symbolBlock = document.getElementById('symbol-block');
//Liste des symbols à afficher
let symbols = null;
//Les case à cocher des paramètres d'affichages de l'symbol
let symbolCheckboxes = document.getElementsByClassName('symbol-checkbox');
// Récupérer le choix de symbol
let symbolChoice = document.getElementById('symbol_symbol_choice');

let playButtonSymbolSound = document.getElementById('play-symbol-sound');

const init = () => {
  symbolLevel.selectedIndex = 0;
  symbolGetGroupButton.checked = false;
  for (let checkbox of symbolCheckboxes) {
    checkbox.checked = false;
    let element = document.getElementById(checkbox.id + '_field');
    checkbox.addEventListener('change', function () {
      element.hidden = checkbox.checked !== true;
    });
  }

  symbolPlaySoundButton.addEventListener('click', function () {
    symbolSound.play();
  });
};

//Permet de récupérer les hirganas par rapport au level choisi
const initAllSymbols = async () => {
  if (symbolLevel.value === '') {
    symbolGetButton.hidden = true;
    return;
  } else {
    symbolGetButton.hidden = false;
    symbolGroupLevel.hidden = false;
    symbolGetGroupButton.checked = false;
  }
  let response = await fetch(symbolGetRoute.value + '/' + symbolChoice.value + '/' + symbolLevel.value);

  if (response.ok) {
    symbols = await response.json();
    symbolGetButton.type = 'button';
    symbolBlock.hidden = false;
  } else {
    alert('HTTP-Error: ' + response.status);
  }
};

//Permet de récupérer les groupes d'hirganas par rapport au level choisi
const initGroupSymbols = async (element) => {
  let response = await fetch(symbolGetGroupRoute.value + '/' + symbolChoice.value + '/' + symbolLevel.value);
  if (response.ok) {
    symbols = null;
    symbols = await response.json();
  } else {
    alert('HTTP-Error: ' + response.status);
  }
};

init();

symbolLevel.addEventListener('change', async function () {
  await initAllSymbols();
});

symbolChoice.addEventListener('change', async function () {
  await initAllSymbols();
});

symbolGetGroupButton.addEventListener('change', async function () {
  if (this.checked === true) {
    await initGroupSymbols(this);
  } else {
    await initAllSymbols();
  }
});

const nextSymbol = () => {
  const randomIndex = Math.floor(Math.random() * symbols.length);
  let symbol = JSON.parse(symbols[randomIndex]);
  roomajiShow.innerHTML = symbol['roomaji'];
  symbolShow.innerHTML = symbol['japanese'];
  symbolSound.src = symbolSoundAsset.value + symbol['roomaji'] + '.mp3';
  if (symbolButtonSound.checked) {
    symbolSound.play();
  }
};

//afficher un hirgana au hazard
symbolGetButton.addEventListener('click', function () {
  nextSymbol();
});

document.addEventListener('keypress', function (e) {
  if (e.key === 'Enter' || e.key === 'Space') {
    if (symbolBlock.hidden === false) {
      nextSymbol();
    }
  }
});

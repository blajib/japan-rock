import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
  static targets = [
    'levelChoice',
    'symbolGetButton',
    'symbolGroupSelect',
    'symbolGetRoute',
    'symbolGetGroupRoute',
    'roomajiShowField',
    'symbolShowField',
    'groupCheckbox',
    'roomajiShowCheckbox',
    'symbolShowCheckbox',
    'soundCheckbox',
    'symbolGetSound',
    'audioPlayer',
    'playButton',
    'symbolBlock',
    'symbolChoice',
  ];

  symbols= null;

  connect() {
    this._init();
  };

  _init() {
    this._manageEvents();

    this.levelChoiceTarget.selectedIndex = 0;
    this.symbolGroupSelectTarget.checked = false;
    let allBoxes = [
      this.groupCheckboxTarget,
      this.roomajiShowCheckboxTarget,
      this.symbolShowCheckboxTarget,
      this.soundCheckboxTarget
    ]

    for (let checkbox of allBoxes) {
      checkbox.checked = false;
      let element = document.getElementById(checkbox.id + '_field');
      checkbox.addEventListener('change', function () {
        element.hidden = checkbox.checked !== true;
      });
    }

    this.playButtonTarget.addEventListener('click', function () {
      this.audioPlayerTarget.play();
    });
  };

  async _initAllSymbols() {
    if (this.levelChoiceTarget.value === '') {
      this.symbolGetButtonTarget.hidden = true;
      return;
    } else {
      this.symbolGetButtonTarget.hidden = false;
      this.symbolGroupSelectTarget.hidden = false;
      this.groupCheckboxTarget.checked = false;
    }
    let response = await fetch(this.symbolGetRouteTarget.value + '/' + this.symbolChoiceTarget.value + '/' + this.levelChoiceTarget.value);

    if (response.ok) {
      this.symbols = await response.json();
      this.symbolGetButtonTarget.type = 'button';
      this.symbolBlockTarget.hidden = false;
    } else {
      alert('HTTP-Error: ' + response.status);
    }
  };

 async _initGroupSymbols() {
    let response = await fetch(this.symbolGetGroupRouteTarget.value + '/' + this.symbolChoiceTarget.value + '/' + this.levelChoiceTarget.value);
    if (response.ok) {
      symbols = null;
      symbols = await response.json();
    } else {
      alert('HTTP-Error: ' + response.status);
    }
  };

  _nextSymbol(){
    const randomIndex = Math.floor(Math.random() * symbols.length);
    let symbol = JSON.parse(symbols[randomIndex]);
    this.roomajiShowFieldTarget.innerHTML = symbol.romaji;
    this.symbolShowFieldTarget.innerHTML = symbol.japanese;
    audioPlayer.src = this.symbolGetSoundTarget.value + symbol.romaji + '.mp3';
    if (this.soundCheckboxTarget.checked) {
      audioPlayer.play();
    }
  };

  _manageEvents(){
    this.levelChoiceTarget.addEventListener('change', async  () => {
      await this._initAllSymbols();
    });

    this.symbolChoiceTarget.addEventListener('change', async () => {
      await this._initAllSymbols();
    });

    this.groupCheckboxTarget.addEventListener('change', async () => {
      if (this.groupCheckboxTarget === true) {
        await this._initGroupSymbols(this);
      } else {
        await this._initAllSymbols();
      }
    });

    this.symbolGetButtonTarget.addEventListener('click',  () => {
      this._nextSymbol();
    });

    document.addEventListener('keypress',  (e) => {
      if (e.key === 'Enter' || e.key === 'Space') {
        if (this.symbolBlockTarget.hidden === false) {
          this._nextSymbol();
        }
      }
    });
  };
}

var cardsArray = [{
  'name': 'American Dog',
  'img': 'img/Match_2.jpg'
}, {
  'name': 'Argo Tea',
  'img': 'img/Match_3.jpg'
}, {
  'name': 'Anntie Anne',
  'img': 'img/Match_4.jpg'
}, {
  'name': 'BSmooth',
  'img': 'img/Match_5.jpg'
}, {
  'name': 'Burrito Beach',
  'img': 'img/Match_6.jpg'
}, {
  'name': 'CIBO',
  'img': 'img/Match_7.jpg'
}, {
  'name': 'Fresh Market',
  'img': 'img/Match_8.jpg'
}, {
  'name': 'Green Market',
  'img': 'img/Match_9.jpg'
}, {
  'name': 'ICE',
  'img': 'img/Match_10.jpg'
}, {
  'name': 'Jamha Juice',
  'img': 'img/Match_11.jpg'
}, {
  'name': 'La Tapenade',
  'img': 'img/Match_12.jpg'
}, {
  'name': 'McDonalds',
  'img': 'img/Match_13.jpg'
}];

const gameGrid = cardsArray
  .concat(cardsArray)
  .sort(() => 0.5 - Math.random());

let firstGuess = '';
let secondGuess = '';
let count = 0;
let previousTarget = null;
let delay = 1200;

const game = document.getElementById('game');
const grid = document.createElement('section');
grid.setAttribute('class', 'grid');
game.appendChild(grid);

gameGrid.forEach(item => {
  const { name, img } = item;

  const card = document.createElement('div');
  card.classList.add('card');
  card.dataset.name = name;

  const front = document.createElement('div');
  front.classList.add('front');

  const back = document.createElement('div');
  back.classList.add('back');
  back.style.backgroundImage = `url(${img})`;

  grid.appendChild(card);
  card.appendChild(front);
  card.appendChild(back);
});

const match = () => {
  const selected = document.querySelectorAll('.selected');
  selected.forEach(card => {
    card.classList.add('match');
  });
};

const resetGuesses = () => {
  firstGuess = '';
  secondGuess = '';
  count = 0;
  previousTarget = null;

  var selected = document.querySelectorAll('.selected');
  selected.forEach(card => {
    card.classList.remove('selected');
  });
};

grid.addEventListener('click', event => {

  const clicked = event.target;

  if (
    clicked.nodeName === 'SECTION' ||
    clicked === previousTarget ||
    clicked.parentNode.classList.contains('selected') ||
    clicked.parentNode.classList.contains('match')
  ) {
    return;
  }

  if (count < 2) {
    count++;
    if (count === 1) {
      firstGuess = clicked.parentNode.dataset.name;
      console.log(firstGuess);
      clicked.parentNode.classList.add('selected');
    } else {
      secondGuess = clicked.parentNode.dataset.name;
      console.log(secondGuess);
      clicked.parentNode.classList.add('selected');
    }

    if (firstGuess && secondGuess) {
      if (firstGuess === secondGuess) {
        setTimeout(match, delay);
      }
      setTimeout(resetGuesses, delay);
    }
    previousTarget = clicked;
  }

});

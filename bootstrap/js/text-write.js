let app = document.getElementById('textwrite');

let typewriter = new Typewriter(textwrite, {
  loop: true,
  delay: 75,
});

typewriter
  .pauseFor(2500)
  .typeString('Technologue en imagerie médicale mais')
  .pauseFor(300)
  .deleteChars(10)
  .typeString('<strong>JS</strong>  Développeur web et mobile. ')
  .typeString('<strong>Je possède une large connaissance en solutions digitales et <span style="color: #27ae60;">je peux réaliser de gros projets</span> comme celui-ci !</strong>')
  .pauseFor(1000)
  .start();
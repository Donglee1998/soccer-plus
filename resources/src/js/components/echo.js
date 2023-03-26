import echo from '../vendors/echo';

echo.init({
  offset: 100,
  throttle: 250,
  unload: false,
  callback: (element, op) => {
    if (op === 'load') {
      element.classList.add('loaded');
    } else {
      element.classList.remove('loaded');
    }
  },
});

import $ from 'jquery';
// Make jQuery available out of bundle
window.jQuery = $;
window.$ = $;

/*
 * Remove default style on HMR
 */
const removeDefaultStyle = () => {
  const links = document.querySelectorAll('link');
  for (let i = 0; i < links.length; i++) {
    if (links[i].getAttribute('rel') === 'stylesheet' && links[i].getAttribute('href').indexOf('style.min.css')) {
      links[i].parentNode.removeChild(links[i]);
    }
  }
  console.log('Default styles is removed.');
};
if (module.hot) {
  // removeDefaultStyle();
}

/*
 * App wrapper
 */
const app = {
  elExists: (arr) => {
    let isExist = false;
    $.each(arr, function(index, value) {
      if ($(value).length) {
        isExist = true;
      }
    });
    return isExist;
  },
};

export default app;

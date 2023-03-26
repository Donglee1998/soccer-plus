import {
  polyfill,
} from 'es6-promise';
polyfill(); // Promise Polyfill for IE 11
import app from './app';

const biggerlinkArr = [
  '.biggerlink',
];

if (app.elExists(biggerlinkArr)) {
  import( /* webpackChunkName: "biggerlink" */ './components/biggerlink');
}
// Lazyload for images
if (app.elExists(['[data-echo]'])) {
  import( /* webpackChunkName: "echo" */ './components/echo');
}

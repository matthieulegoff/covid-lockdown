/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// Import jQuery
import 'jquery';

// Import Bootstrap framework
import 'bootstrap';

// Configure moment locale
import moment from 'moment';
moment.locale('fr');

// Import Chart.js
import 'chart.js';
import 'chartjs-plugin-annotation';

import './scripts/charts';
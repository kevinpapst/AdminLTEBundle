// ------ jquery and bootstrap basics ------
// create global $ and jQuery variables
const $ = require('jquery');
global.$ = global.jQuery = $;

require('jquery-ui');
require('bootstrap-sass');
require('jquery-slimscroll');
require('bootstrap-select');

const Moment = require('moment');
global.moment = Moment;
require('daterangepicker');

// ------ for charts ------
const Chart = require('chart.js/Chart.min');
global.Chart = Chart;

// ------ AdminLTE framework ------
require('./admin-lte.scss');
require('admin-lte/dist/css/AdminLTE.min.css');
require('admin-lte/dist/css/skins/_all-skins.css');
require('./admin-lte-extensions.scss');

global.$.AdminLTE = {};
global.$.AdminLTE.options = {};
require('admin-lte/dist/js/app.min');

// ------ Theme itself ------
require('./default_avatar.png');

// ------ icheck for enhanced radio buttins and checkboxes ------
require('icheck');
require('icheck/skins/square/blue.css');

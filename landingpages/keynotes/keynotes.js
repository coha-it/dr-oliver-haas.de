// REPLACE h1 TAG
(function () {
  var h1 = document.getElementsByTagName('h1')[0];
  var h1txt = h1.innerHTML;

  var ntxt = h1txt.replace(/Keynotes /, 'Keynotes <span class="smaller">');

  // if changes
  if (ntxt != h1txt) {
    ntxt += '</span>';
  }

  // replace
  h1.innerHTML = ntxt;
})();


// VueJS?
var app = new Vue({
  el: '#app',
  data: {
    url: 'https://api.corporate-happiness.de/dist/dr_oliver_haas_events.json',
    events: [],
    aMonthNames: [
      'Januar','Februar','März','April','Mai','Juni','Juli',
      'August','September', 'Oktober','November','Dezember'
    ],
    wrapperClass: 'pre',
  },
  mounted () {
    this.callApi();

    var _t = this;
    window.addEventListener('load', function () {
      _t.wrapperClass = 'post'
    })
  },
  methods: {
    callApi: function () {
      axios.get(this.url).then(response => (this.events = response['data']))
    },
    // getDate: function(event) {
    //   return new Date(event.date);
    // },
    // getDay: function(event) {
    //   var iDay = this.getDate(event).getDay();
    //   var sDay = iDay.toString();
    //   return (iDay <= 9) ? "0"+sDay : sDay;
    // },
    // getMonth: function(event) {
    //   var _t = this;
    //   // return 2;
    //   return _t.getDate(event).getMonth();
    //   return _t.aMonthNames[
    //     _t.getDate(event).getMonth()
    //   ].substring(0, 3);
    // },
    // getYear: function(event) {
    //   return this.getDate(event).getFullYear();
    // },
    getBackground: function(event) {
      return 'background-image: url("'+ event.img_url + '")';
    },
    getListElementStyling: function (event, i) {
      var delay = (i+1)*100;

      return 'transition-delay: '+delay+';';
    }
  }
})


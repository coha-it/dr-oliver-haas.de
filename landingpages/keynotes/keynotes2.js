// REPLACE h1 TAG
(function () {
  var h1 = document.getElementsByTagName('h1')[0];
  var h1txt = h1.innerHTML;

  var ntxt = h1txt.replace(/Termine /, 'Termine <span class="smaller">');

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
    wrappers: [
      {
        follower: false,
        class: 'expired',
        filter: function (event) {
          return event.expired == true;
        }
      },
      {
        follower: true,
        class: 'available',
        filter: function (event) {
          return event.expired == false;
        }
      }
    ]
  },
  mounted () {
    this.callApi();

    var _t = this;
    window.addEventListener('load', function () {
      // Add Post Class
      _t.wrapperClass = 'post'

      // Scroll to First Available
      var $ = jQuery;
      $('html, body').stop().animate( {
        'scrollTop': $('.keynote.available').offset().top - $('.main_title').outerHeight()
      });
    })
  },
  methods: {
    callApi: function () {
      axios.get(this.url).then(response => (this.events = response['data']))
    },
    getBackground: function(event) {
      return 'background-image: url("'+ event.img_url + '")';
    },
    getListElementStyling: function (event, i) {
      var delay = (i+1)*100;
      return 'transition-delay: '+delay+';';
    }
  }
})


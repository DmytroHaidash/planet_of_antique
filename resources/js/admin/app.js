require('./bootstrap');
import Vue from 'vue';
import VModal from 'vue-js-modal'

import MultiUploader from './components/MultiUploader'
import SingleUploader from './components/SingleUploader'
import PasswordChange from "./components/PasswordChange";

Vue.use(VModal);

new Vue({
  el: '#app',
  components: {
    SingleUploader,
    MultiUploader,
    PasswordChange
  },
  mounted() {
    require('./modules/notifications');
    require('./modules/phone-mask');
  }
});

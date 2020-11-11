require('./bootstrap');
import Vue from 'vue';
import VModal from 'vue-js-modal'

import MultiUploader from './components/MultiUploader'
import SingleUploader from './components/SingleUploader'
import PasswordChange from "./components/PasswordChange";
import BlockEditor from "./components/BlockEditor";

Vue.use(VModal);

new Vue({
  el: '#app',
  components: {
    SingleUploader,
    MultiUploader,
    PasswordChange,
    BlockEditor
  },
  mounted() {
    require('./modules/notifications');
    require('./modules/phone-mask');
  }
});

import Vue from 'vue';
import Buefy from 'buefy';
import 'vue-orgchart/dist/style.min.css'
import { VoBasic } from 'vue-orgchart'


Vue.use(Buefy);
Vue.component('v-toast', require('./components/tool/v-toast.vue').default);
Vue.component('v-table', require('./components/tool/v-table.vue').default);
Vue.component('v-competence', require('./components/jobs/v-competence.vue').default);
Vue.component('v-summary-options', require('./components/summary/v-options.vue').default);
Vue.component('v-survey', require('./components/survey/v-survey.vue').default);
Vue.component('v-modal-job', require('./components/jobs/v-modal-job.vue').default);
Vue.component('org-chart', VoBasic );
Vue.component('v-search', require('./components/dashboard/v-search.vue').default);
Vue.component('v-pdi', require('./components/pdi/v-pdi.vue').default);
Vue.component('v-lock', require('./components/ojectives/v-lock.vue').default);
Vue.component('v-table-team', require('./components/team/v-table-team.vue').default);
Vue.component('v-survey-response', require('./components/survey/v-survey-response.vue').default);
Vue.component('v-ev-perfil', require('./components/ev_perfil/v-ev-perfil.vue').default);
Vue.component("v-form-control", require("./components/ev_control/v-form-control.vue").default);
Vue.component('v-generic-autocomplete', require('./components/v-generic-autocomplete.vue').default);



new Vue({
    el: '#app',
});

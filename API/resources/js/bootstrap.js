import axios from 'axios';
window.axios = axios;

window.axios.defaults.withCredentials = true;
window.axios.withXSRFToken = true;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';




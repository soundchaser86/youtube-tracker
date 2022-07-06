import './bootstrap';
import { createApp } from 'vue'
import VueAxios from 'vue-axios';
import axios from 'axios';

import VideoListComponent from './components/VideoListComponent.vue'

const app = createApp({})

app.use(VueAxios, axios);

app.component('video-list-component', VideoListComponent)

app.mount('#app')

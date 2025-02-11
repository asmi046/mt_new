import './bootstrap';

import {createApp} from 'vue/dist/vue.esm-bundler';
import axios from 'axios'
import VueAxios from 'vue-axios'
import { VMaskDirective } from 'v-slim-mask'

import Pay from "./components/Pay.vue"


if (document.getElementById("pay_app")) {
    const pay_app = createApp({
        components:{
            Pay
        },
        setup() {}
    })

    pay_app.use(VueAxios, axios)
    pay_app.directive('mask', VMaskDirective)
    pay_app.mount("#pay_app");
}



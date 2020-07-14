// The Vue build version to load with the `import` command
// 这里是一定会执行的
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
//引入自定义全局变量
import '../config/global.js'

//引入animate.css
import animated from 'animate.css'
Vue.use(animated)

//引入swiper
import VueAwesomeSwiper from 'vue-awesome-swiper'
// require styles
import 'swiper/dist/css/swiper.css'
//设swiper为全局的
Vue.use(VueAwesomeSwiper, /* { default global options } */)



//引入axios
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)




Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})

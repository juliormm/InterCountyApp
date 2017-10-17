
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

import VueRouter  from 'vue-router'
// import router     from './router'
import Vue        from 'vue'


Vue.use(VueRouter)


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/Example.vue'));
// Vue.component('favorite', require('./components/Favorite.vue'));
// 
// Vue.component('store-check', {
// 	props: [ 'store_id', 'campaign_id'],
	
// 	// data() {
// 	// 	return {
// 	// 		addStore: false;
// 	// 	};
// 	// },

// 	template: `
// 		<input type="checkbox"  v-bind:id="'store_' + store_id" v-model="checked" v-on:change="updateData(item)">
// 	`,

// 	methods: {
// 		updateData(item) {
			
// 			// console.log(this.checked)
// 		}
// 	}
// })
// 
// 
// 
// 
Vue.component('store-locations', {
  props:['address', 'phone'],
  template: `<div>
				<location v-for="loc in locations"></location>
  			</div>
  			`,

	data() {
		return {locations: [{item:'one'}, {item:'two'}]};
	}
});

Vue.component('location', {
  
  template: `
	 <div class="form-group">
        <label for="logo">Address</label>
        <input class="form-control" placeholder="store address" name="address{{ $loop->iteration }}" type="text" value="{{ old('address.$loop->iteration',$loc->address) }}">
    </div>
    <div class="form-group">
        <label for="logo">Phone</label>
        <input class="form-control" placeholder="store phone" name="phone{{ $loop->iteration }}" type="text" value="{{ old('phone.$loop->iteration',$loc->phone) }}">
    </div>
  `

});

// const router = new VueRouter({
//   routes: [
//     // dynamic segments start with a colon
//     { path: '/stores/create', component: User }
//   ]
// })


// const routes = [
//     {path: '/stores/create', component: User}
// ]



// Vue.component('example-component', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
// 
// const NotFound = { template: '<p>Page not found</p>' }
// const Home = { template: '<p>home page</p>' }
// const About = { template: '<p>about page</p>' }
// const routes = {
//   '/': Home,
//   '/about': About
// }
// new Vue({
//   el: '#app',
//   data: {
//     currentRoute: window.location.pathname
//   },
//   computed: {
//     ViewComponent () {
//       return routes[this.currentRoute] || NotFound
//     }
//   },
//   render (h) { return h(this.ViewComponent) }
// })

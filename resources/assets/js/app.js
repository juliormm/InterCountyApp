/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

// import VueRouter  from 'vue-router'
// import router     from './router'
// import Vue        from 'vue'


// Vue.use(VueRouter)


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
// Vue.component('store-locations', {
//   props:['address', 'phone'],
//   template: `<div>
// 				<location v-for="loc in locations"></location>
//   			</div>
//   			`,

// 	data() {
// 		return {locations: [{item:'one'}, {item:'two'}]};
// 	}
// });

// Vue.component('location', {

//   template: `
// 	 <div class="form-group">
//         <label for="logo">Address</label>
//         <input class="form-control" placeholder="store address" name="address{{ $loop->iteration }}" type="text" value="{{ old('address.$loop->iteration',$loc->address) }}">
//     </div>
//     <div class="form-group">
//         <label for="logo">Phone</label>
//         <input class="form-control" placeholder="store phone" name="phone{{ $loop->iteration }}" type="text" value="{{ old('phone.$loop->iteration',$loc->phone) }}">
//     </div>
//   `

// });

// const router = new VueRouter({
//   routes: [
//     // dynamic segments start with a colon
//     { path: '/stores/create', component: User }
//   ]
// })


// const routes = [
//     {path: '/stores/create', component: User}
// ]



// Vue.component('store-brand-component', require('./components/StoreBrand.vue'));

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
// 
// 
// 
// 



$(document).ready(function() {
    // console.log(brandList);
    if ($("#campaign-edit").length > 0) {
        // console.log('running');

        $("#campaign-stores ul li").each(function(index) {
            const liStore = $(this);
            const storeID = this.id.replace("store_", "");
            const storeInput = $(".store-item", this);
            const brandBox = $(".brand-box", this);
            // check store
            if (dData[storeID]) {
                storeInput.prop("checked", true);
                activateBrands(brandBox, dData[storeID]);

                liStore.addClass('selected');
                brandBox.removeClass('hidden');

                autoCheckBrands(brandBox, dData[storeID]);
            }

            storeInput.change(function() {
                if (!dData.hasOwnProperty(storeID)) {
                    dData[storeID] = []
                }

                if (this.checked) {
                    activateBrands(brandBox)
                    brandBox.removeClass('hidden');
                    liStore.addClass('selected');

                } else {
                    dData[storeID] = []
                    brandBox.addClass('hidden');
                    liStore.removeClass('selected');
                    const warning = brandBox.find('.brand-warning');
                    warning.removeClass('hidden');
                    deactiveBrands(brandBox)
                    handleStores({store: storeID, action:'clearAll'}, '/campaigns/1/remove/store');

                }
            });
        });
    } else {
        console.log('other');
    }
});

// function assignData()

function showURLBox(store_id, brand_id){
	const input = $('#urlExit_'+store_id+'-'+brand_id);
	// console.log(input.parent());
	input.parent().removeClass('hidden');
}

function hideURLBox(store_id, brand_id){
	const input = $('#urlExit_'+store_id+'-'+brand_id);
	// console.log(input.parent());
	input.parent().addClass('hidden');
}

function autoCheckBrands(parent, data) {
    const brandGroups = parent.find('.brand-group');
    // const urlBox = parent.find('.ulrbox-item');
    const warning = parent.find('.brand-warning');

    brandGroups.each(function(idx, item) {
    	const chkBox = $('.checkbox-item', item);
    	const urlBox = $('.ulrbox-item', item);

        const brandID = $(chkBox).data('brand-id');
        const storeID = $(chkBox).data('store-id');
        // console.log(chkBox.prop("checked"));
        if (data.hasOwnProperty(brandID)) {
            chkBox.prop("checked", true);
            urlBox.val(data[brandID]);
            // $(urlBox).value(data[brandID]);
            showURLBox(storeID, brandID)
            warning.addClass('hidden');
        }
    });
}

function checkMessage(parent){
	const brandChkBoxs = parent.find('input[type="checkbox"]');
	const warning = parent.find('.brand-warning');
	let empty = true;
	brandChkBoxs.each(function(idx, item) {
		if(this.checked && empty){
			empty = false;
		}
	});

	if(empty) {
		warning.removeClass('hidden');
	} else {
		warning.addClass('hidden');
	}
}

function activateBrands(parent) {
    console.log('binding...')
    const brandGroups = parent.find('.brand-group');

    // console.log(brandGroups);

    brandGroups.each(function(idx, item) {
        // add listeners
        $('.checkbox-item', item).on("click", function() {
            const brandID = $(this).data('brand-id');
            const storeID = $(this).data('store-id');
            const send = { store: storeID, brand: brandID }
            
            if(this.checked){
            	send['action'] = 'add';
            	showURLBox(storeID, brandID);
            } else {
            	send['action'] = 'remove';
            	hideURLBox(storeID, brandID);
            }
            handleStores(send, '/campaigns/1/update');
            checkMessage(parent);
        });

        $('.ulrbox-item', item).on("focusout", function() {
        	const brandID = $(this).data('brand-id');
            const storeID = $(this).data('store-id');
            const send = { store: storeID, brand: brandID, action: 'urlexit', url: $(this).val() };
            handleStores(send, '/campaigns/1/update');

            console.log(brandID, storeID);


        });

    })
}

function deactiveBrands(parent) {
    console.log('unbinding...')
    const brandChkBoxs = parent.find('input[type="checkbox"]');
    brandChkBoxs.each(function(idx, item) {
        // const brandID = $(item).data('brand-id');
        $(item).prop("checked", false);
        $(item).off();
    })
}



function handleStores(dataObj, url) {

	// const url = (store) ? '/campaigns/1/remove/store' : '/campaigns/1/update';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var posting = $.post(url, dataObj, function(data) {

    		// showURLBox(dataObj['store'], dataObj['brand']);
            // console.log();
        }, 'json')
        .done(function() {
            // console.log("second success");
        })
        .fail(function() {
            // console.log("error");
        })
        .always(function() {
            // console.log("finished");
        });
}
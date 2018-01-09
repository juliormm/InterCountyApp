/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap')

window.Vue = require('vue')

// Imports
import Vue from 'vue'
import Router from 'vue-router'
import routes from './routes'

Vue.use(Router)

// Components
Vue.component('store-panel', require('./components/StorePanel.vue'))
Vue.component('location-panel', require('./components/LocationPanel.vue'))
Vue.component('campaign-panel', require('./components/CampaignPanel.vue'))

// Instantiation
new Vue({
    el: '#app'
})

// ================================

$(document).ready(function() {

    if ($("#campaign-edit").length > 0) {
        // console.log('running');
        const blocker = $(".loading-blocker");
        blocker.show();

        // setup
        $("#campaign-stores ul li").each(function(index) {
            const liStore = $(this);
            const storeID = this.id.replace("store_", "");
            const storeInput = $(".store-item", this);
            const brandBox = $(".brand-box", this);

            if ($('#creativeID_' + storeID).length) {
                const creativeID = $('#creativeID_' + storeID);


                // setup creative id interactions
                let oldValue = creativeID.val();
                creativeID.on("focusin", function() {
                    oldValue = $(this).val();
                });

                creativeID.on("focusout", function() {
                    elmVal = $(this).val();
                    if (oldValue != elmVal && storeInput.prop("checked")) {
                        const send = { requester: 'creativeID', store: storeID, campaign: +hyfn.currCamp, creative: elmVal };
                        apiCall(send, '/tracking');
                    }
                });
            }

            if (storeInput.prop("checked")) {
                activateBrands(brandBox);
            }

            storeInput.on("click", function(event) {
                if (this.checked) {
                    activateBrands(brandBox)
                    brandBox.removeClass('hidden');
                    liStore.addClass('selected');

                } else {
                    if (confirm('Do you want to deactivet store?')) {
                        brandBox.addClass('hidden');
                        liStore.removeClass('selected');
                        const warning = brandBox.find('.brand-warning');
                        warning.removeClass('hidden');
                        deactiveBrands(brandBox)
                        apiCall({ requester: 'storeCheck', store: storeID, action: 'clearAll' }, '/campaigns/'+ hyfn.currCamp +'/remove/store');
                    } else {
                          event.preventDefault();
                        // event.stopPropagation();
                    }

                }
            });
        });

        blocker.hide();
    } else {
        console.log('other');
    }
});


// function assignData()

function showURLBox(store_id, brand_id) {
    const input = $('#urlExit_' + store_id + '-' + brand_id);
    input.parent().removeClass('hidden');
}

function hideURLBox(store_id, brand_id) {
    const input = $('#urlExit_' + store_id + '-' + brand_id);
    input.parent().addClass('hidden');
}

// function autoCheckBrands(parent, data) {
//     const brandGroups = parent.find('.brand-group');
//     const warning = parent.find('.brand-warning');

//     brandGroups.each(function(idx, item) {
//         const chkBox = $('.checkbox-brand-item', item);
//         const urlBox = $('.ulrbox-item', item);

//         const brandID = $(chkBox).data('brand-id');
//         const storeID = $(chkBox).data('store-id');
//         // console.log(chkBox.prop("checked"));
//         if (data.brand.hasOwnProperty(brandID)) {
//             chkBox.prop("checked", true);
//             urlBox.val(data.brand[brandID]);
//             // $(urlBox).value(data[brandID]);
//             showURLBox(storeID, brandID)
//             warning.addClass('hidden');
//         }
//     });
// }

function clearAllURLs(storeID){
    const parent = $('#store_'+storeID);
    const brandChkBoxs = parent.find('input.ulrbox-item:text');
    brandChkBoxs.each(function(idx, item) {
        $(item).val('');
        $(item).parent().addClass('hidden');
    });
}

function checkMessage(storeID) {

    const parent = $('#store_'+storeID);
    const brandChkBoxs = parent.find('input.checkbox-brand-item:checkbox');
    const warning = parent.find('.brand-warning');
    let empty = true;

    brandChkBoxs.each(function(idx, item) {
        if (this.checked) {
            empty = false;
        }
    });

    if (empty) {
        warning.removeClass('hidden');
    } else {
        warning.addClass('hidden');
    }
}

function activateBrands(parent) {
    const brandGroups = parent.find('.brand-group');
    brandGroups.each(function(idx, item) {
        // add listeners

        $('.checkbox-brand-item', item).on("click", function(event) {
            const brandID = $(this).data('brand-id');
            const storeID = $(this).data('store-id');
            const send = { requester: 'brandCheck', store: storeID, brand: brandID }
            const parent = $(this).parent();
            let runAction = false;
            if (this.checked) {
                send['action'] = 'add';
                showURLBox(storeID, brandID);
                runAction = true;
            } else {

                if (confirm('Do you want to deactivet brand?')) {
                    send['action'] = 'remove';
                    hideURLBox(storeID, brandID);
                    runAction = true;
                } else {
                    event.preventDefault();
                }
            }

            if(runAction){
                apiCall(send, '/campaigns/'+ hyfn.currCamp +'/update');
                checkMessage(storeID);
            }

        });

        let oldValue = $('.ulrbox-item', item).val();
        $('.ulrbox-item', item).on("focusin", function() {
            oldValue = $(this).val();
        });

        $('.ulrbox-item', item).on("focusout", function() {
            console.log(oldValue);
            const brandID = $(this).data('brand-id');
            const storeID = $(this).data('store-id');
            const valElm = $(this).val();
            if(oldValue != valElm){
                const send = { requester: 'exitURL', store: storeID, brand: brandID, action: 'urlexit', url: valElm };
                apiCall(send, '/campaigns/'+ hyfn.currCamp +'/update');
            }

        });

    })
}

function deactiveBrands(parent) {
    const brandChkBoxs = parent.find('input[type="checkbox"]');
    brandChkBoxs.each(function(idx, item) {
        // const brandID = $(item).data('brand-id');
        $(item).prop("checked", false);
        $(item).off();
    })
}


function processCreativeID(json) {
    const elm = $('#creativeID_' + json['request']['store']);
    const msg = $('#creativeIDmsg_' + json['request']['store']);
    msg.removeClass('alert-success alert-danger');
    msg.text(json['message']);

    if (json['status'] != 'OK') {
        msg.addClass('alert-danger');
        elm.val('');
        setTimeout(function() {
            msg.hide();

        }, 5000);
    } else {
        msg.addClass('alert-success');
        setTimeout(function() {
            msg.hide();
        }, 2000);
    }

     msg.show();
}

function processBrandCheck(json){
    const elm = $('#brandName_' + json['request']['store'] + '-'+json['request']['brand']);
    if (json['status'] != 'OK') {
      elm.parent().css('color', 'red');
      setTimeout(function() {
            elm.parent().css('color', '');
        }, 2000);

    } else {
        elm.parent().css('color', '#00da00');
        setTimeout(function() {
            elm.parent().css('color', '');
        }, 2000);
    }

}

function processExitURL(json){
     const elm = $('#urlExit_' + json['request']['store'] + '-'+json['request']['brand']);

     if (json['status'] != 'OK') {
      elm.css('background-color', '#f2dede');
      setTimeout(function() {
            elm.css('background-color', '');
        }, 2000);

    } else {
        elm.css('background-color', '#dff0d8');
        setTimeout(function() {
            elm.css('background-color', '');
        }, 2000);
    }
}

function processStoreCheck(json){

    const elm = $('#creativeID_' + json['request']['store']);

    // const msg = $('#creativeIDmsg_' + json['request']['store']);
    // console.log(elm.parent())
    if (json['status'] != 'OK') {
      //  elm.parent().css('background-color', '#f2dede');
      // setTimeout(function() {
      //        elm.parent().css('background-color', '');
      //   }, 2000);

    } else {
        elm.val('');
        clearAllURLs(json['request']['store']);
        //  elm.parent().css('background-color', '#dff0d8');
        // setTimeout(function() {
        //      elm.parent().css('background-color', '');
        // }, 2000);
    }
}


function apiCall(dataObj, url) {

    // const url = (store) ? '/campaigns/1/remove/store' : '/campaigns/1/update';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var posting = $.post(hyfn.appURL + url, dataObj, function(data) {
            if (data['requester'] === 'creativeID') {
                processCreativeID(data);
            }

            if (data['requester'] === 'brandCheck') {
                processBrandCheck(data);
            }

            if(data['requester'] === 'exitURL'){
                processExitURL(data);
            }

            if(data['requester'] === 'storeCheck'){
                processStoreCheck(data)
            }

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
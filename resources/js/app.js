
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import $ from 'jquery';
import 'datatables.net';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

//Datatables 
$(function() {
    $('#users-table').DataTable({
	  	"pagingType": "simple",
		buttons: [
			{ extend:'copy', attr: { id: 'allan' } }, 'csv', 'excel', 'pdf', 'print'
		]
    });
});

//Confirmation action button
$('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
	e.preventDefault();
	var $form=$(this);
	$('#confirm').modal({ backdrop: 'static', keyboard: false })
	    .on('click', '#delete-btn', function(){
	        $form.submit();
	});
});

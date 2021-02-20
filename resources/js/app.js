import Comparator from "./comparator";
import RequestAjax from "./request-ajax";
import Modal from './modal';
import PermissionsManager from './permissions-manager';
import UserRolesManager from './user-roles-manager';

window.$ = require('jquery');
require('./bootstrap');
require('alpinejs');

let ajax = new RequestAjax();
let comparator = new Comparator();
let modal = new Modal();

new PermissionsManager({
    comparator: comparator,
    ajax: ajax,
    modal: modal
});

new UserRolesManager({
    comparator: comparator,
    ajax: ajax,
    modal: modal
});



import Comparator from "./comparator";
import RequestAjax from "./request-ajax";
import Modal from './modal';
import Confirmation from './confirmation';
import DatatablesManager from './datatables-manager';
import PermissionsManager from './permissions-manager';
import UserRolesManager from './user-roles-manager';

window.$ = require('jquery');
require('./bootstrap');
require('alpinejs');
require('datatables.net')

let ajax = new RequestAjax();
let comparator = new Comparator();
let modal = new Modal();
let confirmation = new Confirmation();
let dtManager = new DatatablesManager();

new PermissionsManager({
    comparator: comparator,
    ajax: ajax,
    modal: modal,
    confirmation: confirmation,
    dtManager: dtManager
});

new UserRolesManager({
    comparator: comparator,
    ajax: ajax,
    modal: modal,
    confirmation: confirmation,
    dtManager: dtManager
});



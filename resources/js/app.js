import './bootstrap';

import '../css/bootstrap-appends.css';

import Alpine from 'alpinejs';

import 'filepond/dist/filepond.min.css';
import * as FilePond from 'filepond';

window.Alpine = Alpine;

window.FilePond = FilePond;

Alpine.start();

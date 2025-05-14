/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

// load bootstrap
import 'bootstrap/dist/css/bootstrap.min.css';
// import customer css if have
import './styles/app.scss';

import { startStimulusApp } from '@symfony/stimulus-bundle';

const app = startStimulusApp();